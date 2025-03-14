function doPrint(order)
{
    const printText = replaceWithEscSequences(printContent(order))
    console.log(printText)
    var S = "#Intent;scheme=rawbt;";
    var P =  "package=ru.a402d.rawbtprinter;end;";
    var textEncoded = encodeURI(printText);
    window.location.href="intent:"+textEncoded+S+P;
}

function replaceWithEscSequences(text) {
    
    // Handle lines that have both [L] and [R]
    text = text.replace(/\[L\](.*?)\[R\](.*)/g, function(match, leftText, rightText) {
        const totalLength = 31; // Assuming 32 characters per line for 58mm paper
        const leftLength = leftText.trim().length; // Trim extra spaces
        const rightLength = rightText.trim().length;
        const spaces = totalLength - (leftLength + rightLength); // Calculate spaces between left and right text
        
        // Make sure there is at least one space between left and right text
        return leftText + ' '.repeat(spaces > 0 ? spaces : 1) + rightText;
    });

    // Replace [C], [L], [R] with corresponding alignment ESC sequences
    text = text.replace(/\[C\]/g, '\x1B\x61\x01');  // Center alignment
    text = text.replace(/\[L\]/g, '\x1B\x61\x00');  // Left alignment
    text = text.replace(/\[R\]/g, '\x1B\x61\x02');  // Right alignment
  
    // Replace horizontal lines with actual dashes
    text = text.replace(/-{32,}/g, '--------------------------------');
  
    // Add newline for each break
    text = text.replace(/\n/g, '\n');
  
    return text;
}

function printContent(order)
{
    // var formatter = new Intl.NumberFormat('en-US', {});

    var invoiceItems = "[C]--------------------------------\n";
    order.items.forEach((item,index)=>{
        if(index == 0 || item.category_id != order.items[index-1].category_id)
            invoiceItems += `[L]${item.category_name}\n`
        
        invoiceItems += `[L]${item.product_name}\n`
        invoiceItems += `[L]x ${item.qty}\n`
    })
    invoiceItems += "[C]--------------------------------\n";

    var app = window.app
    const notes = order.customer_name + "\nNo. Meja " + order.table_name + ' - No. Lantai ' + order.floor_name

    var printText = "[C]"+app.name+"\n" +
                    "[C]"+app.address+"\n" +
                    "[C]--------------------------------\n" +
                    "[C]"+notes+"\n" +
                    "[C]--------------------------------\n" +
                    "[C] Catatan : "+order.description+"\n" +
                    "[C]--------------------------------\n" +
                    "[C]"+order.created_at+"\n" +
                    invoiceItems +
                    "[C]"+app.footer
                    ;
    return printText;
}
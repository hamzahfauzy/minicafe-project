$('.add-item-button').click(async function(){
    const selectedItem = {
        product: $('select[name=product]').find(':selected')[0],
    }
    
    const selectedData = {
        product: sanitizeSelected(selectedItem.product.text)
    }

    const productId = $('select[name=product]').val()
    
    const qty = parseInt($('input[name=qty]').val())

    const foundItem = items.findIndex(item=>item.key==productId)
    
    let price = await $.getJSON('/minicafe/orders/get-price?product_id='+productId)
    
    const data = {
        key:productId,
        name: selectedData.product,
        price: price.price ?? 0,
        qty: foundItem != -1 ? items[foundItem].qty+qty : qty,
        target: selectedItem.product.dataset.target,
        target_id: selectedItem.product.dataset.targetid,
        product: productId,
    }

    let row = foundItem == -1 ? `<div class="accordion-item" id="accordion-item-${data.key}">` : ''
    
    row += `<input type="hidden" name="items[${foundItem != -1 ? foundItem : items.length}][product_id]" value="${data.product}">
            <input type="hidden" name="items[${foundItem != -1 ? foundItem : items.length}][target_id]" value="${data.target_id}">
            <input type="hidden" name="items[${foundItem != -1 ? foundItem : items.length}][price]" value="${data.price}">
            <input type="hidden" name="items[${foundItem != -1 ? foundItem : items.length}][total]" value="${data.price*data.qty}">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#item-${data.key}" aria-expanded="true" aria-controls="item-${data.key}">
                    ${data.name} x ${data.qty}
                </button>
            </h2>
            <div id="item-${data.key}" class="accordion-collapse collapse" data-bs-parent="#accordionItem">
                <div class="accordion-body">

                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <button class="btn btn-sm btn-danger remove-item-button me-2" type="button" data-target="#item-${data.key}" data-key="${data.key}"><i class="fas fa-trash"></i></button>
                            <span class="item-price">Rp. ${(data.price*data.qty).toLocaleString()}</span>
                        </div>

                        <div class="d-flex">
                            <button class="btn btn-sm btn-danger minus-qty-item-button" type="button" data-key="${data.key}"><i class="fas fa-minus"></i></button>
                            <input type="number" class="form-control qty-input text-center" style="width:50px" name="items[${foundItem != -1 ? foundItem : items.length}][qty]" value="${data.qty}" data-key="${data.key}" readonly>
                            <button class="btn btn-sm btn-primary add-qty-item-button" type="button" data-key="${data.key}"><i class="fas fa-add"></i></button>
                        </div>
                    </div>
                
                </div>
            </div>`

    row += foundItem != -1 ? `</div>` : ''


    if(foundItem == -1) {
        items.push(data)
        $('#accordionItem').append(row)
    } else {
        items[foundItem] = data
        $('#accordion-item-'+data.key).html(row)
    }

    console.log(items)

    refreshRow()
});

$('.add-customer-button').click(function(){
    const customer = $('#customerSelect').find(':selected')[0]
    $('#customer_name').val(customer.text)
    $('#customer_name').attr('readonly','')
    $('#customer_id').val($('#customerSelect').val())
    $('#customerModal').modal('hide')
});

$('.use-walking-guest').click(function(){
    $('#customer_name').val("")
    $('#customer_name').removeAttr('readonly')
})

$(document.body).on('click', '.add-qty-item-button', async function(){
    var key = $(this).data('key')
    const index = items.findIndex(item=>item.key==key)
    const newQty = items[index].qty+1
    items[index].qty = newQty
    let price = await $.getJSON('/minicafe/orders/get-price?product_id='+key)
    $(`[name='items[${index}][total]']`).val(price.price*newQty)
    $(`#item-${key} .qty-input`).val(newQty)
    $(`#item-${key} .item-price`).html("Rp. "+ (price.price*newQty).toLocaleString())
    $(`#accordion-item-${key} .accordion-button`).html(items[index].name+" x "+newQty)
})

$(document.body).on('click', '.minus-qty-item-button', async function(){
    var key = $(this).data('key')
    const index = items.findIndex(item=>item.key==key)
    const newQty = items[index].qty-1
    items[index].qty = newQty
    let price = await $.getJSON('/minicafe/orders/get-price?product_id='+key)
    $(`[name='items[${index}][total]']`).val(price.price*newQty)
    $(`#item-${key} .qty-input`).val(newQty)
    $(`#item-${key} .item-price`).html("Rp. "+ (price.price*newQty).toLocaleString())
    $(`#accordion-item-${key} .accordion-button`).html(items[index].name+" x "+newQty)
})

$(document.body).on('click', '.remove-item-button', function(){
    var target = $(this).data('target')
    var key = $(this).data('key')
    const index = items.findIndex(item=>item.key==key)
    $(target).parent().remove()
    items.splice(index,1)
    refreshRow()
})

function sanitizeSelected(value)
{
    return value.replace('- Pilih -','')
}

function refreshRow()
{
    if(items.length)
    {
        $('#empty_item').hide()
    }
    else
    {
        $('#empty_item').show()
    }
}
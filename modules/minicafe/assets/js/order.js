$('.add-item-button').click(function(){
    const selectedItem = {
        product: $('select[name=product]').find(':selected')[0],
    }
    
    const selectedData = {
        product: sanitizeSelected(selectedItem.product.text)
    }
    
    const data = {
        key:items.length+1,
        name: selectedData.product,
        qty: 1,
        target: selectedItem.product.dataset.target,
        target_id: selectedItem.product.dataset.targetid,
        product: $('select[name=product]').val(),
    }
    
    const row = `<tr id="item_${items.length+1}">
                <td>
                <input type="hidden" name="items[${items.length}][product_id]" value="${data.product}">
                <input type="hidden" name="items[${items.length}][target_id]" value="${data.target_id}">
                ${items.length+1}
                </td>
                <td>${data.name}</td>
                <td>${data.target}</td>
                <td><input type="number" class="form-control qty-input" style="width:100px" name="items[${items.length}][qty]" value="${data.qty}" data-key="${items.length+1}"></td>
                <td><button class="btn btn-sm btn-danger remove-item-button" type="button" data-target="#item_${items.length+1}" data-key="${items.length+1}"><i class="fas fa-trash"></i></button></td>
                </tr>
                `
    $('.table-item tbody').append(row)
    items.push(data)

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

$(document.body).on('click', '.remove-item-button', function(){
    var target = $(this).data('target')
    var key = $(this).data('key')
    $(target).remove()
    const index = items.findIndex(item => item.key == key);
    if (index > -1) { // only splice array when item is found
        items.splice(index, 1); // 2nd parameter means remove one item only
    }

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
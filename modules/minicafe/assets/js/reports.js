window.reportOrder = $('.datatable-report-order').DataTable({
    // stateSave:true,
    pagingType: 'full_numbers_no_ellipses',
    processing: true,
    search: {
        return: true
    },
    serverSide: true,
    ajax: {
        url: location.href,
        data: function(data){
            // Read values
            var startDate = $('input[name=start_date]').val()
            var endDate = $('input[name=end_date]').val()
            var cafe = $('select[name=cafe]').val()

            // Append to data
            data.searchByDate = {
                startDate,
                endDate
            }

            data.filter = {}
            
            if(cafe)
            {
                data.filter.cafe_id = cafe
            }

            if(!Object.keys(data.filter).length)
            {
                delete data.filter
            }

            // console.log(data)
        }
    },
    aLengthMenu: [
        [25, 50, 100, 200],
        [25, 50, 100, 200]
    ],
})
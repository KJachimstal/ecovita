$('.doctor_search').select2({
    placeholder: 'Wyszukaj doktora...',
    allowClear: true,
    ajax: {
        url: '/doctor/search',
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
            return {
                results: $.map(data, function (item) {
                    return {
                        text: item.first_name + ' ' + item.last_name,
                        id: item.id
                    }
                })
            };
        },
        cache: true
    }
  });
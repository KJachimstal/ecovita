$('.doctor_speciality_search').select2({
    placeholder: 'Wyszukaj gabinet...',
    ajax: {
        url: '/doctor_specialities/search',
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
            return {
                results: $.map(data, function (item) {
                    return {
                        text: item.first_name + ' ' + item.last_name + ' - ' + item.name,
                        id: item.id
                    }
                })
            };
        },
        cache: true
    }
});
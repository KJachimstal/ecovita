$('.patient_search').select2({
  placeholder: 'Wyszukaj pacjenta...',
  allowClear: true,
  ajax: {
      url: '/users/search',
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
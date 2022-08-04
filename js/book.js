$('.book-js').on('click', '#minusC', function(event) {
    event.preventDefault();
    total = 0
    $('.book-js').html('')

    let bookClicked = $(this).parents('.chh').find('.schedule_id').text();

    for (var i = 0; i < arr.length; i++) {
        if (arr[i].schedule_id == bookClicked) {
          arr[i].Quantity-=1;

          if (arr[i].capacity == 0) {
            // remove from main arr and temp arr
            arr.splice(i,1)
            arrtemp.splice(i,1)

            if (arr.length <=0) {
              $('.book-js').html('')
              $('#subtotal').html("&#8369;" + total.toFixed(2))
              break; //break from loop
            }
          }
        }
    }
    for (var j = 0; j < arr.length; j++) {
      itemAppend(arr[j].schedule_id,arr[j].fee, arr[j].capacity);
    }
    //get total
    getTotal()
  });
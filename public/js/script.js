$( document ).ready(function() { 

    var _token = $('meta[name="csrf-token"]').attr('content');

    //first we will attach event listener for scrolling
    $(window).scroll(function(){

        //When we reach the bottom of the page we will call the getData function
        //to execude the ajax
        if($(window).scrollTop() + $(window).height() === $(document).height()){
            getData();
        }
    });

    //the ajax function which will get the data from the server
    function getData(){
        //the container where we will be placing the data
        var container = $('.gallery-container');

        //counter for the displayed elements
        //var displayedElements = container.children('.data-element').length;
        var displayedElements = $("#count_element").val();
        console.log(displayedElements);
  
        var ajaxUrl = container.data('ajax-url');

        //the actual ajax function
        $.ajax({
            type: "POST",
            url: 'scrolling',
            data: {
                //here we send the displayed elements
                //to the php function
                _token: _token, displayedData: displayedElements
            }
        }).done(function(response){
            //if everything is ok the server (PHP getData function)
            //will return response with the remaining data
            //console.log(response);
            // if the object is empty stop the script
            if(response == "")
            {
                return false;
            }
            var dataElement = '';

            //foreach loop where for every element in the returned array
            //we display li element with the data
            $.each(response, function(key,value){
                $("#container").append('<div class="col-md-4 container-item"><img src="/uploads/thumbs/' +  value.picture_name + '"></div>');
                dataElement++;
            }); 
            //console.log(dataElement);

            //last we will append the li elements to the container
            $("#count_element").val(parseInt(dataElement) + parseInt(displayedElements));
        });
    }


});
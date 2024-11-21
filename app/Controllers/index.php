<html>


<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script src="https://ajax.aspnetcdn.com/ajax/jquery/jquery-1.8.0.js"></script>

    <script src="https://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.22/jquery-ui.js"></script>

    <link rel="Stylesheet" href="https://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.10/themes/redmond/jquery-ui.css" />

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript" src="https://unpkg.com/@geoapify/geocoder-autocomplete@^1/dist/index.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://unpkg.com/@geoapify/geocoder-autocomplete@^1/styles/minimal.css">

</head>



<body>

    <div class="container-fluid">

        <div class="col-md-12" style="padding-top: 7rem;">

            <div class="line line-dashed line-lg pull-in"></div>

            <div class="row">

                <table class="table table-bordered" id="orders">

                    <tr>

                        <th>ITEM NAME or PrCode</th>

                        <th>WEIGHT</th>

                        <th>Quantity</th>

                        <th>Total Weight</th>

                        <th>

                        </th>

                    </tr>

                    <tr class="txtMult">

                        <td><input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>"

                                value="<?= csrf_hash() ?>" /> <input class="form-control single-line-code" type="text"

                                id="txtSearch0" /></td>

                        <td><input class="form-control  product_weight single-line-weight" value="0"

                                data-type="product_price" id='product_price_1' name='product_price[]' for="1"

                                readonly />

                        </td> <!-- purchase_cost -->

                        <td><input class="form-control quantity product_price single-line-qty" type='number' value="0"

                                id='quantity_1' name='quantity[]' for="1" /></td>

                        <td><input class="form-control total_cost" type='number' value="0" id='total_cost_1'

                                name='total_cost[]' for='1' readonly /></td>

                        <td><button type="button" name="add" id="add" class="btn btn-success circle">+</button></td>

                    </tr>

                </table>

                <input class="form-control" type='hidden' data-type="product_id_1" id='product_id_1'

                    name='product_id[]' />

            </div>

        </div>



        <div class="line line-dashed line-lg pull-in" style="clear: both;"></div>



        <div class="col-md-12 nopadding">

            <div class="col-md-4 col-md-offset-4 pull-right nopadding">

                <div class="col-md-8 pull-right nopadding">

                    <div class="form-group">

                        <input class="form-control subtotal" type='text' id='subtotal' name='subtotal' readonly />

                    </div>

                </div>

                <div class="col-md-3 pull-right">

                    <div class="form-group">

                        <label>Total Weight: </label>

                    </div>

                </div>

            </div>

        </div>







        <div class="form-group">

            <label for="exampleInputEmail1">Dispatch Location</label>

            <select id="DispatchLoc" class="form-control" required>

                <option selected disabled value="">Select Dispatch Location</option>

                <option value="Auckland">Auckland</option>

                <option value="Wellington">Wellington</option>

                <option value="Christchurch">Christchurch</option>

            </select>

        </div>



        <div class="form-group">

            <label for="exampleInputEmail1">Search Address</label>

            <!-- <input class="form-control address-field autocomplete-container" type="text"  id="street" placeholder="Search Address"> -->

            <div id="street" class="address-field autocomplete-container"></div>

        </div>



        <input type="hidden" class="Apikey" id="Apikey" value="3da7d2419beb4e3e9c8794ecaf810978">





       

        <!-- <div class="address-collection-container">

  <div class="address-row">

    <div class="address-field-with-label main-part  margin-right">

      <label for="street">Street:</label><br>

      <div id="street" class="address-field autocomplete-container"></div>

    </div>

  </div>

</div> -->















        <div class="form-group">

            <label for="exampleInputEmail1">House Number</label>

            <input class="form-control"  id="housenumber" type="text" placeholder="House Number">

        </div>

        <div class="form-group">

            <label for="exampleInputPassword1">Street:</label>



            <input class="form-control" id="street1" type="text" placeholder="Street">

        </div>

        <div class="form-group">

            <label for="exampleInputPassword1">Suburb:</label>



            <input class="form-control" id="suburb" type="text" placeholder="Suburb">

        </div>

        <div class="form-group">

            <label for="exampleInputPassword1">City:</label>

            <input class="form-control" id="city123" type="text" placeholder="City">

        </div>

        <div class="form-group">

            <label for="exampleInputPassword1">Zipcode:</label>

            <input class="form-control Zipcode" id="Zipcode" type="text" placeholder="Zipcode">

        </div>



        <div class="form-group">

            <button type="submit" id="SubmitAddressDetails" class="SubmitAddressDetails btn btn-primary">Submit</button>

            <button id="ClearValue" class="btn btn-danger">Clear Data</button>

        </div>



        <div>

            <div class="form-group">

                <label for="Street">City:</label>

                <input class="form-control NZCity" id="CityCust" type="text" placeholder="City" readonly>



            </div>

            <div class="form-group">

                <label for="Street">Island:</label>



                <input class="form-control NZIsland" id="LocationIsland" type="text" placeholder="Island" readonly>

            </div>

            <div class="form-group">

                <label for="Street">Weight Range:</label>

                <input type="text" name="FinalShippingCost" class="form-control weightRange" id="weightRange" readonly>

            </div>

            <div class="form-group">

                <label for="Street">Final Shipping Cost(Includes GST):</label>

                <input type="text" name="FinalShippingCost" class="form-control FinalShippingCost"

                    id="FinalShippingCost" readonly> <br>

            </div>





        </div>



    </div>

</body>



</html>



<script>

  // check the available autocomplete options on the https://www.npmjs.com/package/@geoapify/geocoder-autocomplete 

  

  let myAPIKey ='3da7d2419beb4e3e9c8794ecaf810978';



//   const myAPIKey = "6dc7fb95a3b246cfa0f3bcef5ce9ed9a";



const streetInput = new autocomplete.GeocoderAutocomplete(

  document.getElementById("street"),

  myAPIKey, {

    allowNonVerifiedHouseNumber: true,

    allowNonVerifiedStreet: true,

    skipDetails: true,

    skipIcons: true,

    placeholder: " "

  });



const SuburbInput = document.getElementById("suburb");

const City = document.getElementById("city123");

const postcodeElement = document.getElementById("Zipcode");

const housenumberElement = document.getElementById("housenumber");

const street1 = document.getElementById("street1");



streetInput.on('select', (street) => {

  // if (street) {

  //   streetInput.setValue(street.properties.street || '');

  // }



  if (street) {

    street1.value = street.properties.street;

  }



  if (street && street.properties.housenumber) {

    housenumberElement.value = street.properties.housenumber;

  }



  if (street && street.properties.postcode) {

    postcodeElement.value = street.properties.postcode;

  }



  //suburb

  if (street && street.properties.city) {

    SuburbInput.value = street.properties.city;

  }



  //city

  if (street && street.properties.state) {

    City.value = street.properties.state;

  }



  getIslandandCity();

});





// stateInput.on('select', (state) => {



//   if (state) {

//     stateInput.setValue(state.properties.state || '');

//   }



//   if (state && state.properties.country) {

//     countryInput.setValue(state.properties.country);

//   }

// });





</script>









<script>

    //get PRCODE  or name and Get weight

// $(function(){

//     $(".single-line-code").autocomplete({

//         source: "<?= site_url('demo/ajax') ?>"

//         });

// // });

//     $(function () {

//     $(".single-line-code:not(.ui-autocomplete-input)").live("focus", function (event) {

//         var tr = $(this).closest('tr');

//         var qty = $('#quantity_').val();

//         var price = $('#product_price_').val();

//         $(this).autocomplete({

//                 source: function (request, response) {

//                 $.ajax({

//                     // url: "/Home/GetAutoCompleteData",

//                     url:"<?= site_url('demo/ajax') ?>",

//                     data: "{'term':'" + request.term + "'}",

//                     dataType: "json",

//                     type: "POST",

//                     contentType: "application/json; charset-utf-8",

//                     success: function (data) {

//                         response($.map(data, function (item) {

//                             return item;

//                         }))

//                     },

//                 });

//             },

//             // minlenght: 1,

//             // select: function (event, ui) {

//             //     //alert($(tr).prop('id'));

//             //     $.ajax({

//             //         type: "POST",

//             //         url: '<?= site_url('demo/Weight') ?>',

//             //         data: {code: ui.item.value },

//             //         success: function (data) {

//             //             $(tr).find('td').find('.single-line-weight').val(data.w);



//             //             var x = $(tr).find('td').find('.single-line-weight').val();

//             //             var y = $(tr).find('td').find('.single-line-qty').val();

                



//             //             var totNumber = (x * y);

//             //             var tot = totNumber.toFixed(2);

//             //             alert(totNumber);





//             //             $(tr).find('td').find('.total_cost').val(tot);

                           

//             //             var subtotal = 0;

//             //             var GramstoKG = 0;



//             //             $('.total_cost').each(function () {

//             //                 subtotal += parseFloat($(this).val());

//             //                 GramstoKG = subtotal / 1000

//             //             });

//             //             $('#subtotal').val(GramstoKG);

//             //         },

//             //     });

//             // },

//         });

//     });

// });







    $(function () {

        $(".single-line-code:not(.ui-autocomplete-input)").live("focus", function (event) {

            var tr = $(this).closest('tr');

            $(this).autocomplete({

                source: function (request, response) {

                    // CSRF Hash

                    var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name

                    var csrfHash = $('.txt_csrfname').val(); // CSRF hash

                    var tr = $(this).closest('tr');

                    // Fetch data

                    $.ajax({

                        url: "<?= site_url('demo/ajax') ?>",

                        type: 'post',

                        dataType: "json",

                        data: {

                            search: request.term,

                            [csrfName]: csrfHash // CSRF Token

                        },

                        success: function (data) {

                            // Update CSRF Token

                            $('.txt_csrfname').val(data.token);

                            response(data.data);

                        }

                    });

                },

                select: function (event, ui) {

                    // Set selection

                    //    $('#txtSearch0').val(ui.item.label); // display the selected text

                    //    $('#product_weight_1').val(ui.item.value); // save selected id to input

                    $(tr).find('td').find('.single-line-code').val(ui.item.label);

                    $(tr).find('td').find('.single-line-weight').val(ui.item.value);

                    return false;

                },

                focus: function (event, ui) {

                    $(tr).find('td').find('.single-line-code').val(ui.item.label);

                    $(tr).find('td').find('.single-line-weight').val(ui.item.value);



                        var x = $(tr).find('td').find('.single-line-weight').val();

                        var y = $(tr).find('td').find('.single-line-qty').val();

                



                        var totNumber = (x * y);

                        var tot = totNumber.toFixed(2);

                        // alert(totNumber);

                        $(tr).find('td').find('.total_cost').val(tot);

                           

                        calculateSubTotal()



                    return false;

                },

            });

        });

    });

    // Script GET Add Rows

    var rowCount = 1;

    $('#add').click(function () {

        rowCount++;

        $('#orders').append('<tr id="row' + rowCount + '"><td><input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" /><input type="text" class="form-control single-line-code" value="" /></td ><td><input class="form-control product_price single-line-weight" type="number"value="0" data-type="product_price" id="product_price_' + rowCount + '" name="product_price[]" for="' + rowCount + '"readonly/></td><input class="form-control value="0" single-line-qty"  type = "hidden" data - type="product_id" id = "product_id_' + rowCount + '" name = "product_id[]" for= "' + rowCount + '" /><td><input class="form-control quantity single-line-qty" value="0" type="number" class="quantity" id="quantity_' + rowCount + '" name="quantity[]" for="' + rowCount + '"/> </td><td><input class="form-control total_cost" type="number" value="0" id="total_cost_' + rowCount + '" name="total_cost[]"  for="' + rowCount + '" readonly/> </td><td><button type="button" name="remove" id="' + rowCount + '" class="btn btn-danger btn_remove cicle">-</button></td></tr > ');

    });



    // Add a generic event listener for any change on quantity or price classed inputs ACP 31/03

    //$("#orders").on('input', 'input.quantity,input.product_weight', function () {

    $("#orders").on('input', 'input.quantity,input.product_price', function () {

        getTotalCost($(this).attr("for"));

    });

    //remove rows

    $(document).on('click', '.btn_remove', function () {

        var button_id = $(this).attr('id');

        $('#row' + button_id + '').remove();

        calculateSubTotal()

    });

    //get Total Cost

    function getTotalCost(ind) {

        var qty = $('#quantity_' + ind).val();

        var price = $('#product_price_' + ind).val();

        var totNumber = (qty * price);

        //alert(totNumber)

        var tot = totNumber.toFixed(2);

        $('#total_cost_' + ind).val(tot);

        calculateSubTotal();

    }

    //calculate subtotal

    function calculateSubTotal() {

        var subtotal = 0;

        var GramstoKG = 0;

        

        $('.total_cost').each(function () {

            subtotal += parseFloat($(this).val());

            GramstoKG = subtotal / 1000

            // alert(GramstoKG);

            // if(isNaN(GramstoKG)) 

            // {

            //     var GramstoKG = 0;

            // }



        });

        $('#subtotal').val(GramstoKG);

    }

    //Get City and Island



    function getIslandandCity(){

      const inputString = $("#Zipcode").prop('value');

        $.ajax({

            url: "<?= site_url('demo/GetCity') ?>",

            method: 'Get',

            data: { code: inputString },

            success: function (response) {



                // var val1 = ui.item.label;



                // var val2 = response.Data.param2;



                $('.NZCity').val(response.data[0].value);

                $('.NZIsland').val(response.data[0].label);

                // $('#LocationIsland').val(response[1].label);

            },

        });

    }





     $(".Zipcode").on("keyup", function () {

        const inputString = $("#Zipcode").prop('value');

        const City = $("#city123").prop('value');

       $.ajax({

             url: "<?= site_url('demo/GetCity') ?>",

            method: 'Get',

             data: { code: inputString, City:City, },

            success: function (response) {



                // var val1 = ui.item.label;



                // var val2 = response.Data.param2;



               $('.NZCity').val(response.data[0].value);

               $('.NZIsland').val(response.data[0].label);

            //    $('#LocationIsland').val(response[1].label);

            },

        });

     });



     





       





    //clear data

    $('#ClearValue').click(function () {

        $('.form-control').val('');

        $("#DispatchLoc").prop('selectedIndex', 0);

        $('subtotal').val('0')

        

    });

    //   get final weight range and final shipping cost 

    $(".SubmitAddressDetails").click(function () {

        const Subtotal = $("#subtotal").prop('value');

        const City = $("#CityCust").prop('value');

        const Island = $("#LocationIsland").prop('value');

        const DispatchLocation = $('#DispatchLoc option:selected').val();

        if (Subtotal != '' && City != '' && Island != '' && DispatchLocation != '') {

            $.ajax({

                url: "<?= site_url('demo/GetFinal') ?>",

                method: 'get',

                data: {

                    Subtotal: Subtotal,

                    City: City,

                    Island: Island,

                    DispatchLocation: DispatchLocation,

                },

                success: function (response) {

                    // console.log(response);

                    $('.weightRange').val(response.data[0].WeightRange);

                    $('.FinalShippingCost').val(response.data[0].FinalShippingCost);

                }

            });

        } else {

            Swal.fire({

                icon: "error",

                title: "Oops...",

                text: "Please check necesarry fields are filled.",

            });

        }

    });



    // $('.single-line-code').on('change', function () {

    //     // var id = $(this).closest('tr').find('input[type=checkbox]').val();

    //     // alert(id)

    

    //     var fullname = $(this).closest('tr').find('.single-line-weight').val();

    //     alert('This is Fullname: ' + fullname);



    // });

    // var tr = $(this).closest('tr');

    // $(tr).find('td').find('.single-line-weight').on('change', function () {

    //     var tr = $(this).closest('tr');

    //     var fullname = $('.single-line-code').val();

    //     alert('This is Fullname: ' + fullname);





    // });

</script>



<style>



.geoapify-autocomplete-input{

  width: 100%;

}



    .address-collection-container {

  max-width: 500px;

  margin: auto;

}



.autocomplete-container {

    position: relative;

}



.address-row {

  display: flex;

  flex-direction: row;

  

  margin-bottom: 10px;

}



.address-row  .main-part {

  flex: 1

}



.small-input {

  width: 90px;

}



.margin-right {

  margin-right: 10px

}



.message-container {

  margin-top: 10px;

}



.button-container {

  margin-top: 20px;

  text-align: right

}



.warning-input {

   border-color: #ffb610;

}



.message-container {

  color: grey;

}

</style>
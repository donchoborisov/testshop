
@extends('layouts.app')

@section('content')



   
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>



    <div class="container">
        <div class="row">
            <div class="col-md-10 ">
                <div class="panel panel-default">
                    <div class="panel-body">
                    @if (Session::has('status'))
                        <div class="alert alert-danger text-center">
                            <p>{{ Session::get('status') }}</p>
                        </div>
                        @endif

                        @if (Session::has('success'))
                        <div class="alert alert-primary text-center">
                            <p>{{ Session::get('success') }}</p>
                        </div>
                        @endif

                        <form onsubmit='disableButton2()' role="form" action="{{route('stripe')}}" method="post" class="stripe-payment"
                            data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                            id="stripe-payment">
                            @csrf

                            <div class='col-md-6'>
                                <div class='col-xs-12 form-group required'>
                                    <label class='control-label'>Name on Card</label> <input class='form-control'
                                        size='4' type='text'>
                                </div>
                            </div>

                            <div class='col-md-6'>
                                <div class='col-xs-12 form-group card required'>
                                    <input autocomplete='off'placeholder="card number"
                                        class='form-control card-num' size='20' type='text'>
                                        <input type="hidden" name="guest_email" value="{{$email}}">
                                        <input type="hidden" name="product_name" value="{{$product->name}}">
                                        <input type="hidden" name="product_price" value="{{$product->price}}">
    

                                </div>
                            </div>

                            <div class='col-md-6'>
                                <div class='col-xs-12  form-group cvc required'>
                                    <label class='control-label'>CVC</label>
                                    <input autocomplete='off' class='form-control card-cvc' placeholder='e.g 595'
                                        size='4' type='text'>

                                     
                                </div>
                                <div class='col-xs-12 form-group expiration required'>
                                    <label class='control-label'>Expiration Month</label> <input
                                        class='form-control card-expiry-month' placeholder='MM' size='2' type='text'>
                                </div>
                                <div class='col-xs-12  form-group expiration required'>
                                    <label class='control-label'>Expiration Year</label> <input
                                        class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text'>
                                </div>
                            </div>

                            <div class='col-md-6'>
                                <div class='col-md-12 hide error form-group'>
                                    <div class='alert-danger alert'>Fix the errors before you begin.</div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <button id="btn2" class="btn btn-success btn-lg btn-block" type="submit">Pay 50% Deposit</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

<script type="text/javascript">
    $(function () {
        var $form = $(".stripe-payment");
        $('form.stripe-payment').bind('submit', function (e) {
            var $form = $(".stripe-payment"),
                inputVal = ['input[type=email]', 'input[type=password]',
                    'input[type=text]', 'input[type=file]',
                    'textarea'
                ].join(', '),
                $inputs = $form.find('.required').find(inputVal),
                $errorStatus = $form.find('div.error'),
                valid = true;
            $errorStatus.addClass('hide');

            $('.has-error').removeClass('has-error');
            $inputs.each(function (i, el) {
                var $input = $(el);
                if ($input.val() === '') {
                    $input.parent().addClass('has-error');
                    $errorStatus.removeClass('hide');
                    e.preventDefault();
                }
            });

            if (!$form.data('cc-on-file')) {
                e.preventDefault();
                Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                Stripe.createToken({
                    number: $('.card-num').val(),
                    cvc: $('.card-cvc').val(),
                    exp_month: $('.card-expiry-month').val(),
                    exp_year: $('.card-expiry-year').val()
                }, stripeRes);
            }

        });

        function stripeRes(status, response) {
            if (response.error) {
                $('.error')
                    .removeClass('hide')
                    .find('.alert')
                    .text(response.error.message);
            } else {
                var token = response['id'];
                $form.find('input[type=text]').empty();
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                $form.get(0).submit();
            }
        }

    });

   // disable button
   $('#payform').submit(function(){
  $('#pay',this)
  .html("Procesing...")
  .attr('disabled','disabled');
  return true;
});


</script>


 



</html>






@endsection

@extends('layouts.front')

@section('title')
    Checkout
@endsection


@section('content')
    <div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container">
            <h6 class="mb-0">
                <a href="{{ url('/') }}">
                    Home
                </a> /
                <a href="{{ url('checkout') }}">
                    Checkout
                </a>
            </h6>
        </div>
    </div>

    <div class="container mt-3">
        <form action="{{ url('faca-a-encomenda') }}" method="POST">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-body">
                            <h6>Detalhes básicos</h6>
                            <hr>
                            <div class="row checkout-form">
                                <div class="col-md-6">
                                    <label for="">Primeiro Nome</label>
                                    <input type="text" required class="form-control firstname"
                                        value="{{ Auth::user()->name }}" name="fname" placeholder="Digite 1º Nome">
                                    <span id="fname_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Sobrenome</label>
                                    <input type="text" required class="form-control lastname"
                                        value="{{ Auth::user()->lname }}" name="lname" placeholder="Sobrenome">
                                    <span id="lname_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Email</label>
                                    <input type="text" required class="form-control email"
                                        value="{{ Auth::user()->email }}" name="email" placeholder="Email">
                                    <span id="email_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">CPF</label>
                                    <input type="text" required class="form-control cpf" value="{{ Auth::user()->cpf }}"
                                        name="cpf" placeholder="CPF">
                                    <span id="cpf_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">DDD + Telefone</label>
                                    <input type="text" required class="form-control phone"
                                        value="{{ Auth::user()->phone }}" name="phone" placeholder="DDD + Telefone">
                                    <span id="phone_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Endereço</label>
                                    <input type="text" required class="form-control address"
                                        value="{{ Auth::user()->address }}" name="address" placeholder="Endereço">
                                    <span id="address_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-3 mt-3">
                                    <label for="">Número</label>
                                    <input type="text" required class="form-control numero"
                                        value="{{ Auth::user()->numero }}" name="numero" placeholder="Número">
                                    <span id="numero_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Bairro</label>
                                    <input type="text" required class="form-control bairro"
                                        value="{{ Auth::user()->bairro }}" name="bairro" placeholder="Bairro">
                                    <span id="bairro_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Cidade</label>
                                    <input type="text" required class="form-control city"
                                        value="{{ Auth::user()->city }}" name="city" placeholder="Cidade">
                                    <span id="city_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Estado</label>
                                    <input type="text" required class="form-control state"
                                        value="{{ Auth::user()->state }}" name="state" placeholder="Estado">
                                    <span id="state_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <label for="">CEP</label>
                                    <input type="text" required class="form-control cep"
                                        value="{{ Auth::user()->cep }}" name="cep" placeholder="CEP">
                                    <span id="cep_error" class="text-danger"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <h6>Detalhes do pedido</h6>
                            <hr>
                            @php $total = 0; @endphp
                            @if ($cartitems->count() > 0)
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Quantidade</th>
                                            <th>Preço</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cartitems as $item)
                                            <tr>
                                                @php $total += ($item->produtos->selling_price * $item->prod_qty) @endphp
                                                <td>{{ $item->produtos->name }}</td>
                                                <td>{{ $item->prod_qty }}</td>
                                                <td>R$ {{ $item->produtos->selling_price }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <h6 class="px-2">Total Geral <span class="float-end">R$ {{ $total }} </span>
                                </h6>
                                <hr>
                                <input type="hidden" name="payment_mode" value="COD">
                                <button type="submit" class="btn btn-success w-100 mb-2">Faça a encomenda | COD</button>
                                <div id="paypal-button-container"></div>
                            @else
                                <h4 class="text-center">Sem Produtos no Carrinho</h4>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script
        src="https://www.paypal.com/sdk/js?client-id=AZKXAJhBaKm4GAY4Jvdzi7nb_VNYTpPKVKLp9Gp0BBo9Gnz6B-Djf6OSLYd4kF-VTqavGBfNF3EJuvQt">
    </script>


    <script>
        paypal.Buttons({
            onClick: function(data, actions) {
                // Minha validação...
                if ($.trim($('.firstname').val()).length == 0) {
                    error_fname = 'Por favor digite o Primeiro Nome';
                    $('#fname_error').text(error_fname);
                } else {
                    error_fname = '';
                    $('#fname_error').text(error_fname);
                }

                if ($.trim($('.lastname').val()).length == 0) {
                    error_lname = 'Por favor digite o Sobrenome';
                    $('#lname_error').text(error_lname);
                } else {
                    error_lname = '';
                    $('#lname_error').text(error_lname);
                }

                if ($.trim($('.email').val()).length == 0) {
                    error_email = 'Por favor digite o Email';
                    $('#email_error').text(error_email);
                } else {
                    error_email = '';
                    $('#email_error').text(error_email);
                }

                if ($.trim($('.cpf').val()).length == 0) {
                    error_cpf = 'Por favor digite o CPF';
                    $('#cpf').text(error_cpf);
                } else {
                    error_cpf = '';
                    $('#cpf').text(error_cpf);
                }

                if ($.trim($('.phone').val()).length == 0) {
                    error_phone = 'Por favor digite o seu Telefone';
                    $('#phone_error').text(error_phone);
                } else {
                    error_phone = '';
                    $('#phone_error').text(error_phone);
                }

                if ($.trim($('.address').val()).length == 0) {
                    error_address = 'Por favor digite o seu Endereço';
                    $('#address_error').text(error_address);
                } else {
                    error_address = '';
                    $('#address_error').text(error_address);
                }

                if ($.trim($('.numero').val()).length == 0) {
                    error_numero = 'Por favor digite o seu Número';
                    $('#numero_error').text(error_numero);
                } else {
                    error_numero = '';
                    $('#numero_error').text(error_numero);
                }

                if ($.trim($('.bairro').val()).length == 0) {
                    error_bairro = 'Por favor digite o seu Bairro';
                    $('#bairro_error').text(error_bairro);
                } else {
                    error_bairro = '';
                    $('#bairro_error').text(error_bairro);
                }

                if ($.trim($('.city').val()).length == 0) {
                    error_city = 'Por favor digite a sua Cidade';
                    $('#city_error').text(error_city);
                } else {
                    error_city = '';
                    $('#city_error').text(error_city);
                }

                if ($.trim($('.state').val()).length == 0) {
                    error_state = 'Por favor digite o seu Estado';
                    $('#state_error').text(error_state);
                } else {
                    error_state = '';
                    $('#state_error').text(error_state);
                }

                if ($.trim($('.cep').val()).length == 0) {
                    error_cep = 'Por favor digite o seu CEP';
                    $('#cep_error').text(error_cep);
                } else {
                    error_cep = '';
                    $('#cep_error').text(error_cep);
                }
                if (error_fname != '' || error_lname != '' ||
                    error_email != '' || error_cpf != '' ||
                    error_phone != '' || error_address != '' ||
                    error_numero != '' || error_bairro != '' ||
                    error_city != '' || error_state != '' ||
                    error_cep != '') {
                    swal("Alert !", "Todos os campos são obrigatórios", "Aviso");
                    return false;
                } else {
                    return true;
                }
            },
            createOrder: function(data, actions) {
                // This function sets up the details of the transaction, including the amount and line item details.
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '{{ $total }}'
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                // This function captures the funds from the transaction.
                return actions.order.capture().then(function(details) {
                    // This function shows a transaction success message to your buyer.
                    var firstname = $('.firstname').val();
                    var lastname = $('.lastname').val();
                    var email = $('.email').val();
                    var cpf = $('.cpf').val();
                    var phone = $('.phone').val();
                    var address = $('.address').val();
                    var numero = $('.numero').val();
                    var bairro = $('.bairro').val();
                    var city = $('.city').val();
                    var state = $('.state').val();
                    var cep = $('.cep').val();

                    $.ajax({
                        method: "POST",
                        url: "/faca-a-encomenda",
                        data: {
                            'fname': firstname,
                            'lname': lastname,
                            'email': email,
                            'cpf': cpf,
                            'phone': phone,
                            'address': address,
                            'numero': numero,
                            'bairro': bairro,
                            'city': city,
                            'state': state,
                            'cep': cep,
                            'payment_mode': "Pago por Paypal",
                            'payment_id': details.id,
                        },
                        success: function(response) {
                            swal(response.status)
                                .then((value) => {
                                    window.location.href = "/meus-pedidos";
                                });
                        }
                    });
                });
            }
        }).render('#paypal-button-container');
    </script>
@endsection

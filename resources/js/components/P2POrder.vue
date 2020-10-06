<template>
    <div class="container mt-4 add-funds-form">
        <div class="row">
            <div class="col-xl-6">
                <form method="POST" action="/p2p/transaction">
                    <input type="hidden" name="_token" v-bind:value="csrf">
                    <input type="hidden" name="sent" value="1">
                    <input type="hidden" name="received" value="0">
                    <input type="hidden" name="order_id" v-bind:value="order['id']">
                    <input type="hidden" name="receiver_user_id" v-bind:value="user['id']">
                    <div v-if="order['type']==='Buy'">
                        <input type="hidden" name="sendCurrency" value="inr">
                        <input type="hidden" name="receiveCurrency" v-bind:value="order['currency']">
                        <input type="hidden" name="receiveAmount" v-bind:value="amount/order['price']">
                        <input type="hidden" name="sendAmount" v-bind:value="amount">
                    </div>
                    <div v-if="order['type']==='Sell'">
                        <input type="hidden" name="sendCurrency" v-bind:value="order['currency']">
                        <input type="hidden" name="receiveCurrency" value="inr">
                        <input type="hidden" name="receiveAmount" v-bind:value="amount">
                        <input type="hidden" name="sendAmount" v-bind:value="amount/order['price']">
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">Pay to - {{user['name']}}</h3>
                                </div>
                                <div class="col-4 text-right">
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="pl-lg-12">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            Rate - {{order['price']}}
                                            <span v-if="order['currency']==='usdt'">
                                            ₹/USDT
                                            </span>
                                            <span v-if="order['currency']==='pst'">
                                                ₹/PST
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="amount">Rupees</label>
                                            <input type="number"
                                                   id="amount"
                                                   v-model="amount"
                                                   class="form-control"
                                                   required
                                                   placeholder="PST">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2" v-if="order['currency']==='pst'">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="account">PST</label>
                                            <input type="account" name="amount"
                                                    id="account"
                                                    class="form-control"
                                                    required
                                                   disabled
                                                   v-model="amount/order['price']"
                                                    placeholder="Accounts">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2" v-if="order['currency']==='usdt'">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="account">USDT</label>
                                            <input type="text" name="amount"
                                                    id="bank_id"
                                                    class="form-control"
                                                    required
                                                   disabled
                                                   v-model="amount/order['price']"
                                                    placeholder="Accounts">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="account">Transaction ID</label>
                                            <input type="text" name="tid"
                                                    id="tid"
                                                    class="form-control"
                                                    required
                                                   value="TNX00"
                                                    placeholder="tnx">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <h2>Max Amount - {{order['amount']}} <span v-if="order['currency']==='usdt'">
                                            USDT
                                            </span>
                                            <span v-if="order['currency']==='pst'">
                                                PST
                                            </span></h2>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                    <div class="badge" v-if="order['type']==='Buy'">Send the money to the bank account and click the below sent button</div>
                                    <div class="badge" v-if="order['type']==='Sell'">Send the {{order['currency']}} to the user and click the below sent button</div>
                                    </div>
                                </div>
                                <button v-bind:disabled="amount/order['price'] > order['amount'] || amount/order['price']<0" type="submit" class="mt-2 btn btn-lg btn-primary">Sent</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-xl-6" v-if="order['type']==='Buy'">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Bank Details</h3>
                            </div>
                            <div class="col-4 text-right">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <th scope="row">Bank Name</th>
                                <td>{{bank['bank_name']}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Account Holder Name</th>
                                <td>{{bank['account_holder_name']}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Account Number</th>
                                <td>{{bank['account_number']}}</td>
                            </tr>
                            <tr>
                                <th scope="row">IFSC</th>
                                <td>{{bank['ifsc']}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Type</th>
                                <td>{{bank['bank_account_type']}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Branch</th>
                                <td>{{bank['bank_branch']}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xl-6" v-if="order['type']==='Sell'">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Receiver Details</h3>
                            </div>
                            <div class="col-4 text-right">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <th scope="row">Name</th>
                                <td>{{user['name']}}</td>
                            </tr>
                            <tr>
                                <th scope="row">User name</th>
                                <td>{{user['username']}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Email Address</th>
                                <td>{{user['email']}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>
<script>
    export default {
        data(){
            return {
                amount:0,
                price:2.5,
                pst:0
            }
        },
        props: ['csrf', 'pst','order', 'bank', 'user'],
        filters: {
            numbertwoDecimal(num){
                return num.toFixed(2);
            },
            numberFourDecimal(num){
                return num.toFixed(4);
            },
        }
    }

</script>
<style>
    textarea {
        resize: none;
    }
</style>

<template>
    <div class="container add-funds-form">
        <div class="row">
            <div class="col-xl-8 col-lg-8 col-sm-12 col-md-12">
                <form method="POST" action="/p2p/create">
                    <input type="hidden" name="_token" v-bind:value="csrf">
                    <input type="hidden" name="type" v-bind:value="type">
                    <input type="hidden" name="currency" v-bind:value="currency">
                    <input type="hidden" name="completed" v-bind:value="0">
                    <input v-if="type==='Sell'" type="hidden" name="bank_id" value="0">
                    <div class="card">
                        <div class="card-body">
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="rate">Rate</label>
                                            <input type="text" name="price"
                                                   id="rate"
                                                   v-model="price"
                                                   class="form-control"
                                                   required
                                                   placeholder="0.50">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mt-4" v-if="currency==='pst'">
                                        <div class="alert alert-success">
                                            1 PST = 0.50 Rs.
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mt-4" v-if="currency==='usdt'">
                                        <div class="alert alert-success">
                                            1 USDT = 73.50 Rs.
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="amount">Amount</label>
                                            <input type="number" name="amount"
                                                   id="amount"
                                                   v-model.number="amount"
                                                   class="form-control"
                                                   required
                                                   v-bind:placeholder="currency"
                                            >
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="badge badge-primary">
                                            Available Balance - {{ balance }} {{ currency }}
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2" v-if="type==='Buy'">
                                    <div class="col-lg-6" v-if="bank.length!==0">
                                        <div class="form-group">
                                            <label class="form-control-label" for="account">Account</label>
                                            <select type="account" name="bank_id"
                                                    id="account"
                                                    class="form-control"
                                                    required
                                                    placeholder="Accounts">

                                                <option v-for="account in bank" v-bind:value="account['id']">{{account['bank_name']}} - {{account['account_holder_name']}}</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mt-4">
                                        <a href="/add_accounts" class="btn mx-auto btn-sm btn-primary">Add Bank Account</a>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <h2>Payable price - {{amount*price}} rs.</h2>
                                    </div>
                                    <input type="hidden" name="payableAmount" v-bind:value="amount*price">
                                </div>
                                <button v-if="type=='Sell'" v-bind:disabled="amount<=0" type="submit" class="mt-2 btn btn-lg btn-primary">Place Order</button>
                                <button v-if="type=='Buy'" v-bind:disabled="bank.length===0 || amount<=0 || balance < amount" type="submit" class="mt-2 btn btn-lg btn-primary">Place Order</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data(){
            return {
                amount:'',
            }
        },
        props: ['csrf', 'currency','type','price', 'pst', 'usdt', 'balance','bank'],
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
    .modal-header{
        background-color: #5e72e4;
        color: white;
    }
    .modal-footer{
        background-color: #5e72e4;
        color: white;
    }
</style>

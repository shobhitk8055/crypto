<template>

        <div class="row">
            <div class="col-xl-8">
                <form method="POST" action="deposit/create">
                    <input type="hidden" name="_token" v-bind:value="csrf">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">Deposit Funds</h3>
                                </div>
                                <div class="col-4 text-right">
                                    <button type="submit" v-bind:disabled="volume<0" class="btn btn-sm btn-primary">Deposit</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="currency">Currency</label>
                                            <select type="currency" name="currency"
                                                    id="currency"
                                                    class="form-control"
                                                    placeholder="PST"
                                                    v-model="currency">
                                                <option value="pst">PST</option>
                                                <option value="usdt">USDT</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        Conversion rate
                                        <ul>
                                            <li>1 PST = {{pst}} Rs</li>
                                            <li>1 USDT = {{usdt}} Rs</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="volume">Volume</label>
                                            <input type="number" name="volume"
                                                   id="volume" required
                                                   class="form-control"
                                                   v-model="volume"
                                                   placeholder="eg. 1000">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 pt-3" v-if="volume<0">
                                        <div class="alert alert-danger">
                                            Volume can't be zero
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="pstRate" v-model="pst">
                                <input type="hidden" name="usdtRate" v-model="usdt">
                                <input type="hidden" name="payableAmount" value="">
                                <input type="hidden" name="validated" value="0">
                                <div class="row alert alert-primary" v-if="currency==='pst'">
                                    Payable amount - {{volume*pst | numbertwoDecimal}} Rs.
                                </div>
                                <div class="row alert alert-primary" v-if="currency==='usdt'">
                                    Payable amount - {{volume*usdt | numbertwoDecimal}} Rs.
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="tid">Transaction ID</label>
                                            <input type="text" name="tid"
                                                   id="tid" required
                                                   class="form-control"
                                                   placeholder="xx">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-10">
                                        <p>Your address - {{ address }}</p>
                                    </div>
                                    <div class="col-lg-10">
                                        <p>Available PST - {{ }}</p>
                                    </div>
                                    <div class="col-lg-10">
                                        <p>Your address - {{ address }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

</template>
<script>
    export default {
        data(){
            return {
                amount:100,
                price:0.42,
                usdtRate:"75.62",
                volume:"",
                currency:"pst",
                payablePst: this.volume*this.pst,
                payableUsdt: this.volume*this.usdt
            }
        },
        props: ['pst', 'usdt', 'address', 'oldName', 'csrf', 'sessionerror', 'deposits'],
        mounted() {
            // fetch('http://api.coinlayer.com/api/live?access_key=f09f38ff1dc0580658ce903577f1b7b3&symbols=usdt&target=inr',{
            //     method: 'get'
            // }).then((response)=>{
            //     return response.json()
            // }).then((rate)=>{
            //     this.usdtRate = rate['rates']['USDT']
            // });
        },
        filters: {
            numbertwoDecimal(num){
                return num.toFixed(2);
            }
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

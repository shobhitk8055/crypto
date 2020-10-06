<template>
        <div class="buy-form mx-4 mb-4" >
            <form method="POST" action="/dashboard/buy">
                <input type="hidden" name="_token" v-bind:value="csrf">
                <input type="hidden" name="type" value="Buy">
                <input type="hidden" name="completed" value="0">
                <label for="price">At Rate   </label>
                <input id="price" required name="price" v-model="price" class="form-control">

                <label for="amount" class="mt-3">Amount (PST) </label>
                <input id="amount" required placeholder="0" name="amount" v-model="amount" type="text" class="form-control">

                <label for="total" class="mt-3">Total (USDT)</label>
                <input type="hidden" v-bind:value="amount*price" id="fake" required placeholder="0" name="total" rows="1"class="form-control">
                <input type="number" disabled v-bind:value="amount*price" id="total" required placeholder="0" name="fake" rows="1"class="form-control">
                <div v-if="balance < (amount*price) " class="badge badge-danger mt-3">You don't have enough USDT</div>

                <p><span class="badge badge-primary mb-0">Available - {{ balance }}  USDT</span></p>
                <button data-toggle="modal" data-book-id="1" data-target="#myModal" v-bind:disabled="balance < (amount*price) || amount <= 0" class="bg-success btn-large btn text-white mt-1 w-100">Place Buy Order</button>
                <input type="hidden" name="initialAmount" v-model="amount">
                <p class="badge pt-4 mb-0">Fees 0.05% *</p>
            </form>
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div
                            class="modal-header"
                        >
                            <h3 class="modal-title float-left text-white">
                                <i class="far fa-check-circle mr-2"></i>Buy Order Placed
                            </h3>
                            <button type="button" class="close text-white" data-dismiss="modal">
                                &times;
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container">
                                <div class="row d-flex flex-column align-items-center">
                                    <div class="col-4">
                                        <img src="../../assets/img/tick2.png" class="w-100" />
                                    </div>
                                    <div class="col-9 mt-2 text-success" style="text-align: center;">
                                        <h3>
                                            Your Buy order has been placed successfully!
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a
                                class=" text-white"
                                data-dismiss="modal"
                                style="cursor: pointer;"
                            >
                                Okay
                            </a>
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
                amount:null,
                price:2.5,
            }
        },
        props: ['csrf', 'oldName', 'pst', 'usdt', 'balance'],
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

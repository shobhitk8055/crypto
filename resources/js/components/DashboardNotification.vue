<template>
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-1">
                </div>
                <!-- Card stats -->
                <div class="row pt-0 mt-0">
                    <div
                        class="alert alert-success w-100"
                        v-bind:class="{
                        'alert-danger': notification==='You are not a active member yet! Activate your account',
                    }"
                        role="alert"
                    >
                        {{notification}}
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
            }
        },
        props: ['csrf', 'notification', 'pst', 'usdt', 'balance'],
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
</style>


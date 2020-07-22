<template>
    <transition name="model">
        <div class="modal-mask">
            <div class="modal-wrapper">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            Please review your response
                        </div>
                        <div class="modal-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td>Qty</td>
                                        <td>Model</td>
                                        <td>Condition</td>
                                        <td>Unit Price</td>
                                        <td>Serial</td>
                                        <td>Notes</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template v-for="details in listQuotation">
                                        <tr v-for="detail in details">
                                            <td>{{detail.qty}}</td>
                                            <td>{{detail.modelName}}</td>
                                            <td>{{detail.condition}}</td>
                                            <td>{{detail.unitPrice}}</td>
                                            <td>{{detail.serialNumber}}</td>
                                            <td>{{detail.note}}</td>
                                        </tr>
                                    </template>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="5">
                                            <span style="font-weight: bold; color: #ff0000" v-if="freeShipping === '0'">DOES NOT include free ground shipping</span>
                                            <span style="font-weight: bold; color: red" v-if="freeShipping === '1'">Free ground shipping included</span>
                                        </td>
                                    </tr>

                                </tfoot>

                            </table>
                            <div style="float:right;">
                                <button v-if="listQuotation.length > 0" type="button" class="btn-primary btn" @click="onSubmit"> Submit</button>
                                <button type="button" class="btn btn-secondary" @click="onClose">Close</button>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
    export default {
        name: "ModalConfirm",

        props: ['listQuotation', 'userId', 'freeShipping'],

        methods: {
            onClose() {
                this.$emit('onClose', false)
            },

            onSubmit() {

                axios.get('/api/ipsupply/addQuotationToDb/' + JSON.stringify(this.listQuotation) + '/' + JSON.stringify(this.userId) + '/' +this.freeShipping)
                .then((res) => {
                    window.location.href = 'http://quote.ipsupply.net/Vender'
                    alert('Thanks for your responses. Our team will contact you ASAP.')
                })
                .catch((err) => {
                    console.log(err)
                })
            }
        },
    }
</script>

<style scoped>
    .modal-mask{
        position: fixed;
        z-index: 9998;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,.5);
        display: table;
        transition: opacity .3s ease;
    }

    .modal-wrapper {
        display: table-cell;
        vertical-align: middle;
    }

    .modal-content {
        width: 800px;
        margin: auto;
    }

    .modal-dialog {
        margin-left: 350px;
    }
</style>

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
                                        <td>{{detail.note}}</td>
                                    </tr>
                                </template>
                                </tbody>

                            </table>
                            <button v-if="listQuotation.length > 0" type="button" class="btn-primary btn" @click="onSubmit"> Submit</button>
                            <button type="button" class="btn btn-secondary" @click="onClose">Close</button>
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

        props: ['listQuotation', 'userId'],

        methods: {
            onClose() {
                this.$emit('onClose', false)
            },

            onSubmit() {
                axios.get('/api/ipsupply/addQuotationToDb/' + JSON.stringify(this.listQuotation) + '/' + JSON.stringify(this.userId))
                .then((res) => {
                    console.log(res)
                    window.location.href = 'http://127.0.0.1:8000/Vender'
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

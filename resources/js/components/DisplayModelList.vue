<template>
    <div>
<!--        <form v-on:submit.prevent="onSubmit(data)">-->
            <table class="table">
                <thead>
                <tr>
                    <td></td>
                    <td>Model</td>
                    <td>Qty</td>
                    <td>Condition</td>
                    <td>Note</td>
                </tr>
                </thead>
                <tbody>
                <template v-for="detail in displayList">
                    <tr >
                        <td>
                            <a @click="toggle(detail.id)" :class="{ opened: opened.includes(detail.id) }">+</a>
                        </td>
                        <td>{{detail.name}}</td>
                        <td>{{detail.qty}}</td>
                        <td>{{detail.condition}}</td>
                        <td>{{detail.note}}</td>
                    </tr>
                    <tr v-if="opened.includes(detail.id)" id="hello">
                        <td colspan="6">
                            <QuotationDetail v-on:getQuotationEachModel="onGetDetail" :model-id="detail.id" :model-name="detail.name" :display-list="displayList"></QuotationDetail>
                        </td>
                    </tr>
                </template>
                </tbody>
            </table>
            <button class="btn-primary btn" style="float: right" type="button" @click="onSubmit">
                Submit
            </button>
<!--        </form>-->

        <div v-if="openModalConfirm">
            <modal-confirm
                :list-quotation="this.fromQuoDetails"
                v-on:onClose="onCloseModal"
                :user-id="this.userId"
            >
            </modal-confirm>
        </div>

    </div>
</template>

<script>
    import QuotationDetail from "./QuotationDetail";
    import ModalConfirm from "./ModalConfirm";
    export default {
        name: "DisplayModelList",
        components: {ModalConfirm, QuotationDetail},
        props: ['userId'],

        data() {
            return {
                displayList: '',
                opened: [],
                fromQuoDetails: [],
                openModalConfirm: false

            }
        },

        methods: {
            getModelFromDBByUserGroup () {
                axios.get('/api/ipsupply/getModelDetail/'+this.userId.id)
                .then((res) => {
                    this.displayList = res.data

                    console.log(this.displayList)
                })
                .catch((err) => {
                    console.log(err)
                })
            },

            toggle(id) {
                const index = this.opened.indexOf(id);
                if (index > -1) {
                    this.opened.splice(index, 1)
                } else {
                    this.opened.push(id)
                }
            },

            onSubmit() {
                console.log(typeof this.fromQuoDetails)
                this.openModalConfirm = true;
            },

            onGetDetail(value) {
                this.fromQuoDetails.push(value);
                //make array unique
                this.fromQuoDetails = [...new Set(this.fromQuoDetails)];
            },

            onCloseModal(value)
            {
                this.openModalConfirm = value;
            }


        },

        mounted() {
            this.getModelFromDBByUserGroup();
        }
    }
</script>

<style scoped>
    #hello{
        display: table-row;
    }



</style>

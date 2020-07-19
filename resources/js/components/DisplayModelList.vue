<template>
    <div>
<!--        <form v-on:submit.prevent="onSubmit(data)">-->
            <table class="table" style="text-align: center
            ;">
                <thead>
                <tr>
                    <td></td>
                    <td class="header-table">Model</td>
                    <td class="header-table">Qty</td>
                    <td class="header-table">Condition</td>
                    <td class="header-table">Serial Number</td>
                    <td class="header-table">Note</td>
                    <td class="header-table">Age</td>
                    <td v-if="is_admin"></td>
                </tr>
                </thead>
                <tbody>
                <template v-for="detail in orderedDisplay" >

                    <tr >
                        <td>
                            <a @click="toggle(detail.id)" :class="{ opened: opened.includes(detail.id) }">+</a>
                        </td>
                        <td class="body-table">{{detail.name}}</td>
                        <td class="body-table">{{detail.qty}}</td>
                        <td class="body-table">{{detail.condition}}</td>

                        <td v-if="detail.serialRequired === 'noneed'">No Require</td>
                        <td v-else>Require</td>

                        <td class="body-table">{{detail.note}}</td>

                        <td v-if="timestamp === detail.created_at" class="rainbow-text">New!</td>
                        <td v-else> </td>

                        <td v-if="is_admin">
                            <button class="btn" @click="removeModelFromDB(detail.id)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" aria-labelledby="delete" role="presentation" class="fill-current">
                                    <path fill-rule="nonzero" d="M6 4V2a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2h5a1 1 0 0 1 0 2h-1v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6H1a1 1 0 1 1 0-2h5zM4 6v12h12V6H4zm8-2V2H8v2h4zM8 8a1 1 0 0 1 1 1v6a1 1 0 0 1-2 0V9a1 1 0 0 1 1-1zm4 0a1 1 0 0 1 1 1v6a1 1 0 0 1-2 0V9a1 1 0 0 1 1-1z"></path>
                                </svg>
                            </button>
                        </td>
                    </tr>
                    <tr v-if="opened.includes(detail.id)" id="hello">
                        <td colspan="7">
                            <QuotationDetail v-on:getQuotationEachModel="onGetDetail" :model-id="detail.id" :model-name="detail.name" :display-list="displayList"></QuotationDetail>
                        </td>
                    </tr>
                </template>
                </tbody>
            </table>

            <br>

            <div style="font-weight:bold;">

                <div style="font-size:16px; text-align:center; width:100%;">Does this quote include free ground shipping?</div>
                <div style="text-align:center; width:100%;">
                    [ <label for="shipping_included_yes"></label><input type="radio" id="shipping_included_yes" name="shipping_included" value="1" v-model="is_freeShipping"> Yes ]
                    [ <label for="shipping_included_no"></label><input type="radio" id="shipping_included_no" name="shipping_included" value="0" v-model="is_freeShipping" checked="checked"> No ]
                </div>
            </div>

            <br>

            <button class="btn-primary btn" style="float: right" type="button" @click="onSubmit">
                Submit
            </button>
<!--        </form>-->

        <div v-if="openModalConfirm">
            <modal-confirm
                :list-quotation="this.fromQuoDetails"
                :free-shipping="this.is_freeShipping"
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
    import _ from "lodash";
    import moment from "moment";

    export default {
        name: "DisplayModelList",
        components: {ModalConfirm, QuotationDetail},
        props: ['userId'],

        data() {
            return {
                displayList: '',
                opened: [],
                fromQuoDetails: [],
                openModalConfirm: false,
                is_admin: false,
                is_freeShipping: '0',
                timestamp: '',
                countErr: 0,
                modelGotErr: ''

            }
        },

        methods: {
            getModelFromDBByUserGroup () {
                axios.get('/api/ipsupply/getModelDetail/'+this.userId.id)
                .then((res) => {
                    for(let i = 0; i < res.data.length; i++)
                    {
                        res.data[i].created_at = res.data[i].created_at.split('T')[0]
                    }
                    this.displayList = res.data
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
                if(this.fromQuoDetails.length === 0)
                {
                    // console.log('vao if 1')
                    this.openModalConfirm = true;
                }else
                {
                    // console.log('vao else 1')
                    for (let i = 0; i < this.fromQuoDetails.length; i ++)
                    {
                        // console.log('vao for 1')
                        for(let j = 0; j < this.fromQuoDetails[i].length; j++)
                        {

                            // console.log('vao for 2')
                            if(this.fromQuoDetails[i][j].qty && this.fromQuoDetails[i][j].unitPrice)
                            {
                                console.log('You re good');
                            }else{
                                return alert('Please specify a quantity, price and condition for '+ this.fromQuoDetails[i][j].modelName  +'. ' +
                                    'Take note that for any line item on this form if you enter a price, ' +
                                    'quantity, or notes you will be required to fill out the price, condition and quantity ' +
                                    'for that item before your response will be accepted.')
                            }
                        }

                    }

                    console.log('Well done!')
                    this.openModalConfirm = true;
                }



                // if(this.countErr > 0){
                //     alert('Please specify a quantity, price and condition for '+ this.fromQuoDetails[0][i].modelName  +'. ' +
                //         'Take note that for any line item on this form if you enter a price, ' +
                //         'quantity, or notes you will be required to fill out the price, condition and quantity ' +
                //         'for that item before your response will be accepted.')
                //     this.countErr = 0;
                // }else{
                //     this.openModalConfirm = true;
                // }

                // this.openModalConfirm = true;
            },

            removeModelFromDB(modelId){
                axios.get('/api/ipsupply/deleteModelFromDB/' + modelId)
                .then((res) => {
                    if(res.data){
                        location.reload();
                    }
                })
                .catch((err) => {
                    console.log(err)
                    alert('Could not found model id')
                })
            },

            onGetDetail(value) {
                this.fromQuoDetails.push(value);
                //make array unique
                this.fromQuoDetails = [...new Set(this.fromQuoDetails)];

            },

            onCloseModal(value)
            {
                this.openModalConfirm = value;
            },

            checkIsAdmin() {
                this.userId.is_admin === 1 ? this.is_admin = true : this.is_admin = false;

            },

            getNow() {
                const today = Date();
                this.timestamp = moment(today).format('YYYY-MM-DD');
            }




        },

        computed: {
            orderedDisplay() {
                return _.orderBy(this.displayList, 'updated_at', 'desc')
            }
        },

        mounted() {
            this.getNow()
            this.getModelFromDBByUserGroup();
            this.checkIsAdmin();


        }
    }
</script>

<style scoped>
    #hello{
        display: table-row;
    }

    .rainbow-text {
        color: violet;
        font-size: 18px;
    }

    .header-table{
        font-weight: bold;
        font-size: 20px;
    }
    .body-table{
        font-size: 18px;
    }

</style>

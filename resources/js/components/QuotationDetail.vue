<template>
    <div>
        <table class="table">
            <thead>
            <tr>
                <th></th>
                <th>Qty</th>
                <th>Condition</th>
                <th>Unit Price</th>
                <th>Serial Number</th>
                <th>Notes</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(quoDetail, index) in quoDetails" >
                <td></td>
                <td>
                    <label>
                        <input class="form-control" maxlength="5" v-model="quoDetail.qty" v-on:keypress="emitToModelDetail"  type="text" value="" style="width:50px;" required>
                    </label>
                </td>
                <td>
                    <label>
                        <select class="form-control" v-model="quoDetail.condition" style="width: 100px" required>
                            <option value="GradeA">Grade A</option>
                            <option value="New">New</option>
                            <option value="NIB">NIB</option>
                            <option value="NOB">NOB</option>
                        </select>
                    </label>
                </td>
                <td>
                    <label>
                        <input type="text" maxlength="10" v-model="quoDetail.unitPrice" style="width:70px;" placeholder="$" class="form-control" required>
                    </label>
                </td>
                <td>
                    <label>
                        <textarea rows="2" cols="30" v-model="quoDetail.serialNumber" maxlength="255" style="width:initial;" class="form-control"></textarea>
                    </label>
                </td>
                <td>
                    <label>
                        <textarea rows="2" cols="30" v-model="quoDetail.note" maxlength="255" style="width:initial;" class="form-control"></textarea>
                    </label>
                </td>
                <td>
                    <button
                        @click="removeQuo(index)"
                        class="btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" aria-labelledby="delete" role="presentation" class="fill-current">
                            <path fill-rule="nonzero" d="M6 4V2a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2h5a1 1 0 0 1 0 2h-1v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6H1a1 1 0 1 1 0-2h5zM4 6v12h12V6H4zm8-2V2H8v2h4zM8 8a1 1 0 0 1 1 1v6a1 1 0 0 1-2 0V9a1 1 0 0 1 1-1zm4 0a1 1 0 0 1 1 1v6a1 1 0 0 1-2 0V9a1 1 0 0 1 1-1z"></path>
                        </svg>
                    </button>
                </td>
            </tr>
            </tbody>
        </table>
        <div>
            <button class="btn" @click="addNewLine" style="float: left"><p style="display: inline;"> + Add other conditions and/or price breaks</p></button>

        </div>
    </div>

</template>

<script>
    import DeleteModelBtn from "./DeleteModelBtn";
    export default {
        name: "QuotationDetail",
        components: {DeleteModelBtn},
        props: ['modelId', 'modelName', 'displayList'],

        data() {
            return {
                quoDetails:[{
                    modelId: this.modelId,
                    modelName: this.modelName,
                    qty: '',
                    condition: '',
                    unitPrice: '',
                    serialNumber: '',
                    note: ''
                }],
                passDataToDisplayModelList: []
            }
        },

        methods: {
            addNewLine() {
                this.quoDetails.push({
                    modelId: this.modelId,
                    modelName: this.modelName,
                    qty: '',
                    condition: '',
                    unitPrice: '',
                    serialNumber: '',
                    note: ''
                })
            },

            removeQuo(index) {
                if(this.quoDetails.length > 1)
                {
                    this.quoDetails.splice(index, 1)
                }
                else{
                    this.quoDetails.splice(index, 1)
                    this.quoDetails.push({
                        modelId: this.modelId,
                        modelName: this.modelName,
                        qty: '',
                        condition: '',
                        unitPrice: '',
                        serialNumber: '',
                        note: ''
                    })

                }

            },

            emitToModelDetail(event) {
                this.$emit('getQuotationEachModel', this.quoDetails)
            }

        },

    }
</script>

<style scoped>

</style>

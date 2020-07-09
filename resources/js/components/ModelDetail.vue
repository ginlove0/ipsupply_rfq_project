<template>
    <div class="container">
        <button @click="handleBack" type="button" class="btn btn-primary mb-2">Back</button>
        <h1> Model Details: </h1>

        <div style="float: right; font-size: 20px">
            <div class="form-check form-check-inline">
                <input class="form-check-input" checked type="checkbox" id="auCheckbox" v-model="group" value="group-au">
                <label class="form-check-label" for="auCheckbox">Australia Group</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" checked type="checkbox" id="usCheckbox" v-model="group" value="group-us">
                <label class="form-check-label" for="usCheckbox">United State Group</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" checked type="checkbox" id="cnCheckbox" v-model="group" value="group-cn">
                <label class="form-check-label" for="cnCheckbox">China Group</label>
            </div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Model</th>
                    <th>Condition</th>
                    <th>Qty</th>
                    <th>Serial Require</th>
                    <th>Note</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="model in listModel" :key="model.id">
                    <td>{{model.name}}</td>
                    <td>
                        <label>
                            <select v-model="model.condition" class="form-control">
                                <option value="any" selected>Any</option>
                                <option value="gradeA">Grade A</option>
                                <option value="new">New</option>
                                <option value="nib">NIB</option>
                                <option value="nob">NOB</option>
                            </select>
                        </label>
                    </td>
                    <td>
                        <label>
                            <select v-model="model.qty" class="form-control">
                                <option value="any" selected>Any</option>
                                <option value="digit">Digit</option>
                            </select>
                        </label>
                    </td>
                    <td>
                        <label>
                            <select v-model="model.serialRequired" class="form-control">
                                <option value="required">Required</option>
                                <option value="noneed" selected>No need</option>
                            </select>
                        </label>
                    </td>
                    <td>
                        <label>
                            <textarea v-model="model.note" type="text" class="w-full form-control form-input form-input-bordered"></textarea>
                        </label>
                    </td>
                    <td>
                        <DeleteModelBtn
                            :id="model.id"
                            :list-model="listModel"
                        />
                    </td>
                </tr>
            </tbody>
        </table>

        <div>
            <button class="btn btn-primary" type="button" @click="handleSubmit">Button</button>
        </div>
    </div>
</template>

<script>
    import DeleteModelBtn from "./DeleteModelBtn";
    export default {
        props: ['listModel', 'isCreateNew', 'isRequestList'],

        components: {DeleteModelBtn},

        data() {
            return{
                group: ["group-au", "group-us", "group-cn"],
                arrayModel: []
            }
        },

        methods: {
            handleBack() {
                this.$emit('onShowCreateNew', true)
                this.$emit('onShowRequestList', false)
                this.$emit('onDeleteOldModelList', [])
            },

            handleSubmit() {
                this.listModel.map((item) => {
                    this.arrayModel.push(item)
                })

                axios.get('/api/ipsupply/addModelDetail/'+ JSON.stringify(this.arrayModel)+'/'+JSON.stringify(this.group))
                    .then((res) => {
                        console.log(res)
                        window.location.href = 'http://127.0.0.1:8000/Vender';
                    })
                    .catch((err) => {
                        console.log(err)
                    });
            }


        },


    }
</script>

<style scoped>
    .table thead th {
        text-align: center;
    }

    .table td {
        text-align: center;
    }
</style>

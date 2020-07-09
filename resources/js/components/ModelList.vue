<template>
    <div>
        <div class="container" v-show="isCreateNew">
            <div>
                <label for="model-textarea" style="font-size: 30px">Model List:</label>
                <textarea v-model="modelList"  class="form-control" id="model-textarea" rows="8"></textarea>
            </div>
            <button @click="handleNext" type="button" style="margin-top: 10px;" class="btn btn-primary mb-2">Next</button>

        </div>
        <div class="container" v-show="isRequestList">
            <ModelDetail
                :list-model="passList"
                :is-create-new="isCreateNew"
                :is-request-list="isRequestList"
                v-on:onShowCreateNew="getOnShowCreateNew"
                v-on:onShowRequestList="getOnShowRequestList"
                v-on:onDeleteOldModelList="deleteOldModelList"
            />
        </div>
    </div>
</template>


<script>
    import ModelDetail from './ModelDetail';
    export default {
        components: {ModelDetail},

        data(){
            return {
                modelList:'',
                listModel: [{
                    id: '',
                    name: '',
                    condition: 'any',
                    qty: 'any',
                    serialRequired: 'noneed',
                    note: ''
                }],
                passList: [],
                isRequestList: false,
                isCreateNew: true
            }
        },

        methods: {
            handleNext() {
                const replaced_space_sn = this.modelList.replace(/\n/gi, " ");
                const replaced_comma_sn = replaced_space_sn.replace(/,/g, " ");
                const arr_sn = replaced_comma_sn.split(' ');
                this.arrayItem = _.uniq(arr_sn);
                var i  = 0;
                this.arrayItem.map((model) => {
                    if(model.length > 0){
                        this.listModel[0].name = model;
                        this.listModel[0].id = ++i;
                        this.passList.push({...this.listModel[0]});
                    }
                });
                if(this.modelList.length > 0){
                    this.isRequestList = true;
                    this.isCreateNew = false;
                }

            },

            handleListModel(){

            },

            getOnShowCreateNew(value) {
                this.isCreateNew = value
            },

            getOnShowRequestList(value) {
                this.isRequestList = value;
            },

            deleteOldModelList(value) {
                this.passList = value;
            }
        }
    }
</script>

<style scoped>

</style>

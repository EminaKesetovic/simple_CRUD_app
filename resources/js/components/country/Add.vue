<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add Country</h4>
                </div>
                <div class="alert alert-danger" role="alert" v-if="errors.length">
                    <b>Please correct the following error(s):</b>
                    <ul>
                        <li v-for="(error,key) in errors" :key="key">{{ error }}</li>
                    </ul>
                </div>
                <div class="card-body">
                    <form @submit.prevent="create">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" maxlength="100" v-model="country.name">
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:"add-country",
    data(){
        return {
            country:{
                name:""
            },
            errors: []
        }
    },
    methods:{
        async create(){
            this.errors = [];

            if (this.country.name) {
                await this.axios.post('/api/country',this.country).then(response=>{
                    this.$router.push({name:"countryList"})
                }).catch(error=>{
                    console.log(error)
                })
            }

            if (!this.country.name) {
                this.errors.push('Name required.');
            }
        }
    }
}
</script>

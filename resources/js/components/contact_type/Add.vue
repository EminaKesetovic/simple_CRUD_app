<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add Contact Type</h4>
                </div>
                <div class="row">
                    <p v-if="errors.length">
                        <b>Please correct the following error(s):</b>
                        <ul>
                            <li v-for="(error,key) in errors" :key="key">{{ error }}</li>
                        </ul>
                    </p>
                </div>
                <div class="card-body">
                    <form @submit.prevent="create">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" maxlength="100" v-model="contact_type.name">
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
    name:"add-contact_type",
    data(){
        return {
            contact_type:{
                name:""
            },
            errors: []
        }
    },
    methods:{
        async create(){
            this.errors = [];

            if (this.contact_type.name) {
                await this.axios.post('/api/contact_type',this.contact_type).then(response=>{
                    this.$router.push({name:"contactTypeList"})
                }).catch(error=>{
                    console.log(error)
                })
            }

            if (!this.contact_type.name) {
                this.errors.push('Name required.');
            }
        }
    }
}
</script>

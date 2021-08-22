<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Update Contact Type</h4>
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
                    <form @submit.prevent="update">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" v-model="contact_type.name">
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Update</button>
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
    name:"update-contact_type",
    data(){
        return {
            contact_type:{
                name:"",
                _method:"patch"
            },
            errors: []
        }
    },
    mounted(){
        this.showContactType()
    },
    methods:{
        async showContactType(){
            await this.axios.get(`/api/contact_type/${this.$route.params.id}`).then(response=>{
                const { name } = response.data
                this.contact_type.name = name
            }).catch(error=>{
                console.log(error)
            })
        },
        async update(){
            this.errors = [];

            if (this.contact_type.name) {
                await this.axios.post(`/api/contact_type/${this.$route.params.id}`,this.contact_type).then(response=>{
                    this.$router.push({name:"contactTypeList"})
                }).catch(error=>{
                    console.log(error)
                })
            }

            this.errors = [];

            if (!this.contact_type.name) {
                this.errors.push('Name required.');
            }
        }
    }
}
</script>

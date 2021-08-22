<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Update Country</h4>
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
                                    <input type="text" class="form-control" maxlength="100" v-model="country.name">
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
    name:"update-country",
    data(){
        return {
            country:{
                name:"",
                _method:"patch"
            },
            errors: []
        }
    },
    mounted(){
        this.showCountry()
    },
    methods:{
        async showCountry(){
            await this.axios.get(`/api/country/${this.$route.params.id}`).then(response=>{
                const { name } = response.data
                this.country.name = name
            }).catch(error=>{
                console.log(error)
            })
        },
        async update(){
            this.errors = [];

            if (this.country.name) {
                await this.axios.post(`/api/country/${this.$route.params.id}`,this.country).then(response=>{
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

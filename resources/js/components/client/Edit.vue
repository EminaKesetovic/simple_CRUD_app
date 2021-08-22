<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Update Client</h4>
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
                                    <input type="text" class="form-control" v-model="client.name">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" class="form-control" v-model="client.address">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>City</label>
                                    <select class='form-control' v-model='client.city_id'>
                                        <option value="" selected disabled>Choose city</option>
                                        <option v-for="(city,key) in cities" :key="key" :value='city.id'>{{ city.name }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Country</label>
                                    <select class='form-control' v-model='client.country_id'>
                                        <option value="" selected disabled>Choose country</option>
                                        <option v-for="(country,key) in countries" :key="key" :value='country.id'>{{ country.name }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Type of industry</label>
                                    <select class='form-control' v-model='client.industry_type_id'>
                                        <option value="" selected disabled>Choose type of industry</option>
                                        <option v-for="(industry_type,key) in industry_types" :key="key" :value='industry_type.id'>{{ industry_type.name }}</option>
                                    </select>
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
    name:"update-client",
    data(){
        return {
            client:{
                name:"",
                address:"",
                city_id:"",
                country_id:"",
                industry_type_id:"",
                contacts:{
                    contact_type_id:"",
                    contact:""
                },
                _method:"patch"
            },
            cities:[],
            countries:[],
            industry_types:[],
            errors: []
        }
    },
    mounted(){
        this.showClient(),
        this.getCities(),
        this.getCountries(),
        this.getIndustryTypes()
    },
    methods:{
        async showClient(){
            await this.axios.get(`/api/client/${this.$route.params.id}`).then(response=>{
                this.client.name = response.data.name
                this.client.address = response.data.address
                this.client.city_id = response.data.city_id
                this.client.country_id = response.data.country_id
                this.client.industry_type_id = response.data.industry_type_id
            }).catch(error=>{
                console.log(error)
            })
        },
        async getCities(){
            await this.axios.get('/api/city').then(response=>{
                this.cities = response.data
            }).catch(error=>{
                console.log(error)
                this.cities = []
            })
        },
        async getCountries(){
            await this.axios.get('/api/country').then(response=>{
                this.countries = response.data
            }).catch(error=>{
                console.log(error)
                this.countries = []
            })
        },
        async getIndustryTypes(){
            await this.axios.get('/api/industry_type').then(response=>{
                this.industry_types = response.data
            }).catch(error=>{
                console.log(error)
                this.industry_types = []
            })
        },
        async update(){
            this.errors = [];

            if (this.client.name) {
                await this.axios.post(`/api/client/${this.$route.params.id}`,this.client).then(response=>{
                    this.$router.push({name:"clientList"})
                }).catch(error=>{
                    console.log(error)
                })
            }

            if (!this.client.name) {
                this.errors.push('Name required.');
            }
        }
    }
}
</script>

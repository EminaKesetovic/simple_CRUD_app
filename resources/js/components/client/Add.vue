<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add Client</h4>
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
                                    <input type="text" class="form-control" maxlength="250" v-model="client.name">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" class="form-control" maxlength="250" v-model="client.address">
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
                                    <label>Industry type</label>
                                    <select class='form-control' v-model='client.industry_type_id'>
                                        <option value="" selected disabled>Choose type of industry</option>
                                        <option v-for="(industry_type,key) in industry_types" :key="key" :value='industry_type.id'>{{ industry_type.name }}</option>
                                    </select>
                                </div>
                            </div>
                            <b>Contacts:</b>
                            <div class="col-12 mb-2" v-for="(contact, key) in client.contacts" v-bind:key="key">
                                <button type="button" class="btn btn-danger" v-if="key!=0" v-on:click="deleteContact(key)">x</button>
                                <div class="form-group">
                                    <label>Contact type</label>
                                    <select class='form-control' v-model='contact.contact_type_id'>
                                        <option value="" selected disabled>Choose type of contact</option>
                                        <option v-for="(contact_type,key) in contact_types" :key="key" :value='contact_type.id'>{{ contact_type.name }}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Contact</label>
                                    <input type="text" class="form-control" maxlength="250" v-model="contact.contact">
                                </div>
                                <hr>
                            </div>
                            <div class="col-12 mb-4 text-end">
                                <button type="button" v-on:click="addContact()" class="btn btn-primary" >Add another contact</button>
                            </div>
                            <hr>
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
    name:"add-client",
    data(){
        return {
            client:{
                name:"",
                address:"",
                city_id:"",
                country_id:"",
                industry_type_id:"",
                contacts:[{
                    contact_type_id:"",
                    contact:""
                }]
            },
            cities:[],
            countries:[],
            industry_types:[],
            contact_types:[],
            valid:true,
            errors:[]
        }
    },
    mounted(){
        this.getCities(),
        this.getCountries(),
        this.getIndustryTypes(),
        this.getContactTypes()
    },
    methods:{
        addContact(){
            this.client.contacts.push({
                contact_type_id:'',
                contact: ''
            })
        },
        deleteContact(key){
            this.client.contacts.splice(key,1);
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
        async getContactTypes(){
            await this.axios.get('/api/contact_type').then(response=>{
                this.contact_types = response.data
            }).catch(error=>{
                console.log(error)
                this.contact_types = []
            })
        },
        async create(){
            this.errors = [];
            this.valid = true;

            if (!this.client.address) {
                this.valid = false;
                this.errors.push('Address required.');
            }

            if (!this.client.city_id) {
                this.valid = false;
                this.errors.push('City required.');
            }

            if (!this.client.country_id) {
                this.valid = false;
                this.errors.push('Country required.');
            }

            for (var i = 0; i < this.client.contacts.length; i++) {
                if (!this.client.contacts[i].contact_type_id) {
                    this.valid = false;
                    this.errors.push('Contact type required.');
                }
                if (!this.client.contacts[i].contact) {
                    this.valid = false;
                    this.errors.push('Contact required.');
                }

                if (!this.valid) break;
            }

            if (this.valid) {
                await this.axios.post('/api/client',this.client).then(response=>{
                    this.$router.push({name:"clientList"})
                }).catch(error=>{
                    console.log(error)
                })
            }
        }
    }
}
</script>

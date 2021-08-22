<template>
    <div class="row">
        <div class="col-12 mb-2 text-end">
            <button class="btn btn-success" v-on:click="getIndustryTypes()">Refresh</button>
            <router-link :to='{name:"industryTypeAdd"}' class="btn btn-primary">Create</router-link>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Industry Type</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group">
                            <input type="search" class="form-control" v-model="filter">
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th v-on:click="sortBy('id')">ID</th>
                                    <th v-on:click="sortBy('name')">Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody v-if="industry_types.length > 0">
                                <tr v-for="(industry_type,key) in sortedIndustryTypes" :key="key">
                                    <td>{{ industry_type.id }}</td>
                                    <td>{{ industry_type.name }}</td>
                                    <td>
                                        <router-link :to='{name:"industryTypeEdit",params:{id:industry_type.id}}' class="btn btn-success">Edit</router-link>
                                        <button v-if="industry_type.clients_number == 0" type="button" v-on:click="deleteIndustryType(industry_type.id)" class="btn btn-danger">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                            <tbody v-else>
                                <tr>
                                    <td colspan="4" align="center">No Industry Types Found.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:"industry_types",
    data(){
        return {
            currentSort:'id',
            currentSortDir:'asc',
            filter:'',
            industry_types:[]
        }
    },
    mounted(){
        this.getIndustryTypes()
    },
    methods:{
        async getIndustryTypes(){
            await this.axios.get('/api/industry_type').then(response=>{
                this.industry_types = response.data
            }).catch(error=>{
                console.log(error)
                this.industry_types = []
            })
        },
        sortBy(column) {
            //if column == current sort, reverse
            if(column === this.currentSort) {
            this.currentSortDir = this.currentSortDir === 'asc' ? 'desc' : 'asc';
            }
            this.currentSort = column;
        },
        deleteIndustryType(id){
            if(confirm("Are you sure to delete this industry type ?")){
                this.axios.delete(`/api/industry_type/${id}`).then(response=>{
                    this.getIndustryTypes()
                }).catch(error=>{
                    console.log(error)
                })
            }
        }
    },
    computed:{
        filteredIndustryTypes() {
            return this.industry_types.filter(industry_type => {
                if(this.filter == '') return true;
                return industry_type.name.toLowerCase().indexOf(this.filter.toLowerCase()) >= 0;
            })
        },
        sortedIndustryTypes:function() {
            return this.filteredIndustryTypes.sort((a,b) => {
                let modifier = 1;
                if(this.currentSortDir === 'desc') modifier = -1;
                if(a[this.currentSort] < b[this.currentSort]) return -1 * modifier;
                if(a[this.currentSort] > b[this.currentSort]) return 1 * modifier;
                return 0;
            });
        }
    }
}
</script>

<template>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form  >
                        <div class="row">
                            <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label >Name</label>
                                        <input type="text" v-model="form.name" class="form-control">
                                        <div v-if="form.errors.has('name')" v-html="form.errors.get('name')" class="text-danger">
                                        </div>
                            </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label >Phone</label>
                                    <input type="text" v-model="form.phone" class="form-control">
                                    <div v-if="form.errors.has('phone')" v-html="form.errors.get('phone')" class="text-danger">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label >Select Order Type</label>
                                   <select class="form-control" v-model="form.orderType" @change="dropDownType">
                                       <option value="pickup">Pick Up</option>
                                       <option value="delivery">Delivery</option>
                                   </select>
                                    <div v-if="form.errors.has('orderType')" v-html="form.errors.get('orderType')" class="text-danger">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6" v-show="this.form.orderType==='pickup'">
                                <div class="form-group mb-4">
                                    <label>Branches</label>
                                    <select class="form-control" v-model="form.branch_id">
                                        <option v-for="item in dropDown" :value="item.id">{{ item.name_en }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6" v-show="this.form.orderType==='delivery'">
                                <div class="form-group mb-4">
                                    <label>Areas</label>
                                    <select class="form-control" v-model="form.area_id">
                                        <option v-for="item in dropDown" :value="item.id">{{ item.name_en }}</option>
                                    </select>
                                </div>
                            </div>


                        </div>
                        <button type="button" @click.prevent="createOrder" class="btn btn-primary mt-2">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    name: "Checkout",
    props:['routeCartCheckoutSubmit'],
    data(){
        return{
            form: new Form({
                name:'',
                phone:'',
                orderType:'',
                branch_id:undefined,
                area_id:undefined,

            }),
            dropDown:{},

        }
    },
    methods:{
        dropDownType(){
            if(this.form.orderType =='pickup')
            {
                axios.get('/vendor/cart/check-out/branches').then((data)=>{
                    this.dropDown=data.data;
                })
            }
            else
            {
                axios.get('/vendor/cart/check-out/areas').then((data)=>{
                    this.dropDown=data.data;
                })
            }
        },
        createOrder(){
            this.form.post(this.routeCartCheckoutSubmit).then(()=>{
                window.location.href="/vendor/orders?create-success;"
            })
        }
    }
}
</script>

<style>

</style>

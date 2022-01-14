<template>
    <div class="row mt-5">
        <div class="col-xl-8">
            <div class="card">




                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0 table-nowrap">
                            <thead class="table-light">
                            <tr>

                                <th></th>
                                <th>Product Name</th>
                                <th>Product Price</th>
                                <th>Quantity</th>
                                <th>Addon Price</th>
                                <th>Total Price</th>
                                <th></th>

                            </tr>
                            </thead>

                            <tbody>
                            <template v-for="(item,i) in items">

                            <tr >
                                <td>#</td>
                                <td>
                                    {{item.name}}
                                </td>
                                <td>
                                    {{item.price}}

                                </td>
                                <td>

                                        <input type="number" min="1"  name="quantity" v-model="item.quantity"  @change="updateQuantity(item.id,item.quantity,i)">
                                </td>
                                <td>{{item.attributes.totalAddonPrice}}</td>
                                <td>{{item.attributes.totalProductPrice}}</td>
                                <td>

                                    <button type="submit" class="btn btn-danger" @click.prevent="deleteItem(item.id)"><li class="bx bx-trash-alt"></li></button>

                                </td>

                            </tr>

                            <tr  :class="'row'+item.id" >
                                <td></td>
                                <table class="table" v-show="!Array.isArray(item.attributes.addonDetailsIds_Quantities)">
                                    <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Unit Price</th>
                                        <th scope="col">Quantity</th>
                                    </tr>
                                    </thead>
                                    <tbody v-for="(addonDetailQuantity,index) in item.attributes.addonDetailsIds_Quantities">

                                    <ItemAddons :addondetailid="index" :addondetailquantity="addonDetailQuantity" :itemquantity="item.quantity"></ItemAddons>

                                    </tbody>
                                </table>


                            </tr>
</template>
                            </tbody>
                        </table>
                    </div>
                    <div class="row mt-4">
                        <div class="col-sm-6">
                            <a :href="routeCreateOrders" class="btn btn-secondary">
                                <i class="mdi mdi-arrow-left me-1"></i> Continue Shopping    </a>
                        </div> <!-- end col -->

                        <div class="col-sm-6" v-show="totalCartPrice > 0">
                            <div class="text-sm-end mt-2 mt-sm-0">
                                <a :href="routeCartCheckout" class="btn btn-success">
                                    <i class="mdi mdi-cart-arrow-right me-1"></i> Checkout </a>
                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end row-->
                </div>
            </div>
        </div>
        <div class="col-xl-4 mb-5">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Card Details</h5>

                    <div class="card bg-primary text-white visa-card mb-0">
                        <div class="card-body">
                            <div>
                                <i class="bx bxl-visa visa-pattern"></i>

                                <div class="float-end">
                                    <i class="bx bxl-visa visa-logo display-3"></i>
                                </div>

                                <div>
                                    <i class="bx bx-chip h1 text-warning"></i>
                                </div>
                            </div>

                            <div class="row mt-5">
                                <div class="col-4">
                                    <p>
                                        <i class="fas fa-star-of-life m-1"></i>
                                        <i class="fas fa-star-of-life m-1"></i>
                                        <i class="fas fa-star-of-life m-1"></i>
                                    </p>
                                </div>
                                <div class="col-4">
                                    <p>
                                        <i class="fas fa-star-of-life m-1"></i>
                                        <i class="fas fa-star-of-life m-1"></i>
                                        <i class="fas fa-star-of-life m-1"></i>
                                    </p>
                                </div>
                                <div class="col-4">
                                    <p>
                                        <i class="fas fa-star-of-life m-1"></i>
                                        <i class="fas fa-star-of-life m-1"></i>
                                        <i class="fas fa-star-of-life m-1"></i>
                                    </p>
                                </div>
                            </div>

                            <div class="mt-5">
                                <h5 class="text-white float-end mb-0">12/22</h5>
                                <h5 class="text-white mb-0">Fredrick Taylor</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3">Order Summary</h4>

                    <div class="table-responsive">
                        <table class="table mb-0">
                            <tbody>
                            <tr>
                                <td>Grand Total :</td>
                                <td>$ 1,857</td>
                            </tr>
                            <tr>
                                <td>Discount : </td>
                                <td>- $ 157</td>
                            </tr>
                            <tr>
                                <td>Shipping Charge :</td>
                                <td>$ 25</td>
                            </tr>
                            <tr>
                                <td>Estimated Tax : </td>
                                <td>$ 19.22</td>
                            </tr>
                            <tr>
                                <th>Total :</th>
                                <th>{{totalCartPrice}}</th>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- end table-responsive -->
                </div>
            </div>
            <!-- end card -->
        </div>
    </div>

</template>

<script>
import ItemAddons from "./ItemAddons";
export default {
    components: {ItemAddons},
    props:['routeCreateOrders','routeCartCheckout'],
    data(){
        return{
           items:{},
            addonPrice:0,
            totalCartPrice:0,
        }
    },
    methods:{
        loadItems(){
            axios.get('/vendor/cart').then((data)=>{
                this.items=data.data.items;
                this.totalCartPrice=data.data.totalCartPrice;

            })
        },
        updateQuantity(id,itemQuantity,index){
            axios.get('/vendor/product/'+id+'/amount').then((data)=>{
                if(itemQuantity > data.data)
                {
                    alert('Sorry, maximum product amount is '+data.data);
                    this.items[index].quantity=data.data;
                }
                else
                {
                    axios.put('/vendor/cart/product/'+id, {
                        quantity: itemQuantity
                    }).then(()=>{
                        Fire.$emit('reloadCart');
                        Toast.fire({
                            icon: 'success',
                            title: 'Updated successfully'
                        });

                    })
                }
            })


        },
        deleteItem(id){
            axios.delete('/vendor/cart/product/'+id).then(()=>{
                Fire.$emit('reloadCart');

            })
        }




    },
    mounted() {
        this.loadItems();
        Fire.$on('reloadCart',()=>{
            this.loadItems();

        })


    },
    name: "VendorCart"
}
</script>

<style scoped>
</style>

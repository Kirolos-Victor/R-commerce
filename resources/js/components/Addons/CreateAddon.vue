<template>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">

                <div class="card-body">
                    <form >
                        <div class="row">
                            <div class="col-lg-6">
                                <div>
                                    <div class="form-group mb-4">
                                        <label for="section_english_name">Section English Name</label>
                                        <input v-model="form.section_name_en" type="text" name="title"  class="form-control" id="section_english_name">
                                        <div v-if="form.errors.has('section_name_en')" v-html="form.errors.get('section_name_en')" class="text-danger"/>                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mt-4 mt-lg-0">
                                    <div class="form-group mb-4">
                                        <label for="section_arabic-name">Section Arabic Name</label>
                                        <input v-model="form.section_name_ar" type="text" name="section_name_ar" id="section_arabic-name" class="form-control input-mask" >
                                        <div v-if="form.errors.has('section_name_ar')" v-html="form.errors.get('section_name_ar')" class="text-danger"/>
                                    </div>
                                </div>
                                </div>


                            <div class="col-lg-6">
                                <div class="mt-4 mt-lg-0">
                                    <div class="form-group mb-4">
                                        <label for="quantity">Quantity</label>
                                        <input type="number" name="quantity" id="quantity" class="form-control input-mask" v-model="form.quantity">
                                        <div v-if="form.errors.has('quantity')" v-html="form.errors.get('quantity')" class="text-danger"/>                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mt-4 mt-lg-0">
                                    <div class="form-group mb-4">
                                        <label >Addon Select Type</label>
                                        <select  v-model="form.addon_select_type" id="addon_select_type" class="form-control input-mask" >
                                            <option value=1>Multiple Select</option>
                                            <option value=2>Must Select</option>
                                        </select>
                                        <div v-if="form.errors.has('addon_select_type')" v-html="form.errors.get('addon_select_type')" class="text-danger"/>                                    </div>

                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mt-4 mt-lg-0">
                                    <div class="form-group mb-4">
                                        <label >Hidden Addon Item</label>
                                        <select  v-model="form.hide_addon_item" id="hidden_addon_item" class="form-control input-mask" >
                                            <option value="2">No</option>
                                            <option value="1">Yes</option>
                                        </select>
                                        <div v-if="form.errors.has('hide_addon_item')" v-html="form.errors.get('hide_addon_item')" class="text-danger"/>                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mt-4 mt-lg-0">
                                    <div class="form-group mt-4">
                                        <label for="quantity-meter" >Quantity Meter</label>
                                        <input type="checkbox" id="quantity-meter" v-model="form.quantity_meter"  true-value=1
                                               false-value=0 >
                                        <div v-if="form.errors.has('quantity_meter')" v-html="form.errors.get('quantity_meter')" class="text-danger"/>                                    </div>

                                </div>
                        </div>
                        </div>
                        <div class="row"  v-for="(addon,index) in addonDetails" :key="index">
                            <div class="col-lg-4">
                                    <div class="form-group mb-4">
                                        <label for="english-name">Addon English Name</label>
                                        <input id="english-name" class="form-control input-mask" type="text" name="name_en" v-model="form.addon_name_en[index]">
                                        <div v-if="form.errors.has('addon_name_en')" v-html="form.errors.get('addon_name_en')" class="text-danger"/>
                                    </div>
                            </div>

                            <div class="col-lg-4">
                                    <div class="form-group mb-4">
                                        <label for="arabic-name">Addon Arabic Name</label>
                                        <input type="text" name="name_ar" id="arabic-name" class="form-control input-mask"  v-model="form.addon_name_ar[index]">
                                        <div v-if="form.errors.has('addon_name_ar')" v-html="form.errors.get('addon_name_ar')" class="text-danger"/>                                    </div>

                            </div>
                            <div class="col-lg-3">
                                    <div class="form-group mb-4">
                                        <label for="price">Price</label>
                                        <input type="number" name="price" id="price" class="form-control input-mask" v-model="form.price[index]">
                                        <div v-if="form.errors.has('price')" v-html="form.errors.get('price')" class="text-danger"/>                                    </div>

                                </div>
                            <div class="col-lg-1">
                                <button class="btn btn-danger mt-4" @click.prevent="removeAddonDetail(index)">x</button>

                            </div>
                        </div>
                      <div class="middle">
                          <button class="btn btn-primary" @click.prevent="addMoreDetails">Add more</button>
                      </div>

                        <button type="submit" class="btn btn-primary mt-2" @click.prevent="createAddon()">Create</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

</template>

<script>
export default {
    name: "CreateAddon",
    props:['routeCreateAddon'],
    data()
    {
        return{
            addonDetails:[0],
            form: new Form({
                section_name_en: '',
                section_name_ar:'',
                quantity:0,
                addon_select_type:1,
                hide_addon_item:1,
                quantity_meter:false,
                    addon_name_en:[],
                    addon_name_ar: [],
                    price: [],
            })

        }
    },
    methods:{
        createAddon(){
            this.form.post(this.routeCreateAddon).then(()=>{

                window.location.href="/vendor/addons?create-success"
            })
        },
        addMoreDetails(){
            this.addonDetails.push(1);
        },
        removeAddonDetail(index){
            if(this.addonDetails.length ===1)
            {
                alert('you must have one addon details')
            }
            else {
                this.form.addon_name_ar.splice(index,1);
                this.form.addon_name_en.splice(index,1);
                this.form.price.splice(index,1);

                this.addonDetails.splice(index,1);

            }
        }

    }
}
</script>

<style scoped>
.middle{
    margin-left: 50%;
}
</style>

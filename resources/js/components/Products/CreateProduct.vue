<template>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">

                <div class="card-body">
                    <form  enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mt-4 mt-lg-0">

                                <div class="form-group mb-4">
                                        <label for="product-english-name">English Name</label>
                                        <input id="product-english-name" class="form-control input-mask" type="text" name="name_en" required v-model="form.name_en">
                                        <div v-if="form.errors.has('name_en')" v-html="form.errors.get('name_en')" class="text-danger">
                                        </div>
                                </div>


                            </div>
                                </div>
                            <div class="col-lg-6">
                                <div class="mt-4 mt-lg-0">
                                    <div class="form-group mb-4">
                                        <label for="product-arabic-name">Arabic Name</label>
                                        <input type="text" name="name_ar" id="product-arabic-name" class="form-control input-mask" required v-model="form.name_ar">
                                        <div v-if="form.errors.has('name_ar')" v-html="form.errors.get('name_ar')" class="text-danger">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div>
                                    <div class="form-group mb-4">
                                        <label for="english-description">English Description</label>
                                        <input id="english-description" class="form-control input-mask" type="text" name="description_en" required v-model="form.description_en">
                                        <div v-if="form.errors.has('description_en')" v-html="form.errors.get('description_en')" class="text-danger">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mt-4 mt-lg-0">
                                    <div class="form-group mb-4">
                                        <label for="arabic-description">Arabic Description</label>
                                        <input type="text" name="description_ar" id="arabic-description" class="form-control input-mask" required v-model="form.description_ar">
                                        <div v-if="form.errors.has('description_ar')" v-html="form.errors.get('description_ar')" class="text-danger">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mt-4 mt-lg-0">
                                    <div class="form-group mb-4">
                                        <label for="amount">Amount</label>
                                        <input type="text" name="amount" id="amount" class="form-control input-mask" required v-model="form.amount">
                                        <div v-if="form.errors.has('amount')" v-html="form.errors.get('amount')" class="text-danger">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mt-4 mt-lg-0">
                                    <div class="form-group mb-4">
                                        <label for="cost">Cost</label>
                                        <input type="text" name="amount" id="cost" class="form-control input-mask" required v-model="form.cost">
                                        <div v-if="form.errors.has('cost')" v-html="form.errors.get('cost')" class="text-danger">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mt-4 mt-lg-0">
                                    <div class="form-group mb-4">
                                        <label for="product-price">Price</label>
                                        <input type="text" name="price" id="product-price" class="form-control input-mask" required v-model="form.price">
                                        <div v-if="form.errors.has('price')" v-html="form.errors.get('price')" class="text-danger">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mt-4 mt-lg-0">
                                    <div class="form-group mb-4">
                                        <label for="image">Image</label>
                                        <input type="file" name="image" id="image" class="form-control input-mask" ref="fileupload" required @change="uploadImage" multiple="multiple" >
                                        <div v-if="form.errors.has('image')" v-html="form.errors.get('image')" class="text-danger">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mt-4 mt-lg-0">
                                    <div class="form-group mb-4">
                                        <label >Branches</label>

                                        <multiselect track-by="id"
                                                     :options="branches"
                                                     v-model="selectedBranches"
                                                     label="name_en"
                                                     @input="addBranchesIds(selectedBranches)"
                                                     :multiple="true"></multiselect>

                                        <div v-if="form.errors.has('branches')" v-html="form.errors.get('branches')" class="text-danger">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mt-4 mt-lg-0">
                                    <div class="form-group mb-4">
                                        <label >Addons</label>

                                        <multiselect
                                            track-by="id"
                                            v-model="selectedAddons"
                                            :options="addons"
                                            label="name_en"
                                            @input="addAddonsIds(selectedAddons)"
                                            :multiple="true"></multiselect>


                                        <div v-if="form.errors.has('addons')" v-html="form.errors.get('addons')" class="text-danger">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mt-4 mt-lg-0">
                                    <div class="form-group mb-4">
                                        <label >Categories</label>

                                        <multiselect track-by="id"
                                                     @input="addCategoriesIds(selectedCategories)"
                                                     :options="categories"
                                                     label="name_en"
                                                     v-model="selectedCategories"
                                                     :multiple="true"
                                        ></multiselect>

                                        <div v-if="form.errors.has('categories')" v-html="form.errors.get('categories')" class="text-danger">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mt-4 mt-lg-0">
                                    <div class="form-group mb-4">
                                        <label for="is_hidden">Is Hidden</label>

                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="is_hidden" name="is_hidden" v-model="form.is_hidden"  :true-value=1 :false-value=0 >
                                        </div>
                                        <div v-if="form.errors.has('is_hidden')" v-html="form.errors.get('is_hidden')" class="text-danger">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                            </div>

                        </div>

                        <button class="btn btn-primary mt-2 mb-4" @click.prevent="createNewAddon =true;" v-show="!createNewAddon">Create New Addon</button>
                    </form>

                        <form v-show="createNewAddon" >
                            <div class="row">
                                <h3 class="text-center mt-4 mb-4">Create Addon</h3>
                                <div class="col-lg-6">
                                    <div>
                                        <div class="form-group mb-4">
                                            <label for="section_english_name">Section English Name</label>
                                            <input  v-model="form.section_name_en" type="text" name="title"  class="form-control" id="section_english_name">
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
                                            <label for="addon_select_type">Addon Select Type</label>
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
                                            <input type="checkbox" id="quantity-meter" v-model="form.quantity_meter"  :true-value=1 :false-value=0 >
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
                                        <input type="number" name="price" id="price" class="form-control input-mask" v-model="form.addon_price[index]">
                                        <div v-if="form.errors.has('addon_price')" v-html="form.errors.get('addon_price')" class="text-danger"/>                                    </div>

                                </div>
                                <div class="col-lg-1">
                                    <button class="btn btn-danger mt-4" @click.prevent="removeAddonDetail(index)">x</button>

                                </div>
                            </div>
                            <div class="middle text-center">
                                <button class="btn btn-primary " @click.prevent="addMoreDetails">Add more</button>
                            </div>


                        </form>
                    <button type="submit" class="btn btn-primary float-left" @click.prevent="createProduct()">Submit</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
</template>

<script>
export default {
    name: "CreateProduct",
    props:['categories','addons','branches','productcreateroute'],

    data()
    {
        return{
            createNewAddon:false,
            selectedAddons:[],
            selectedBranches:[],
            selectedCategories:[],
            addonDetails:[0],
                form: new Form({
                name_en:'',
                name_ar:'',
                description_en:'',
                description_ar:'',
                amount:'',
                image:[],
                is_hidden:0,
                product_price:0,
                cost:0,
                branches:[],
                addons:[],
                categories:[],
                section_name_en: '',
                section_name_ar:'',
                quantity:0,
                addon_select_type:1,
                hide_addon_item:1,
                quantity_meter:false,
                addon_name_en:[],
                addon_name_ar: [],
                addon_price: [],
            })

        }
    },
    methods:{
        createProduct(){
            this.form.post(this.productcreateroute).then(()=>{

                 window.location.href="/vendor/products?create-success"
            })
        },
        uploadImage(e){
           let selectedFiles= e.target.files;
           if(selectedFiles.length >5)
           {
               alert('Sorry, You can not upload more than 5 images');
               this.$refs.fileupload.value=null;           }
           else
           {
               this.form.image=[];
               for (let i=0;i < selectedFiles.length; i++)
               {
                   this.form.image.push(selectedFiles[i]);
               }
           }

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
                this.addonDetails.splice(index,1);

                this.form.addon_name_ar.splice(index,1);
                this.form.addon_name_en.splice(index,1);
                this.form.price.splice(index,1);


            }
        },
        addBranchesIds(selectedBranches){
            this.form.branches=[];
            selectedBranches.forEach((branch)=>
            {
               this.form.branches.push(branch.id);
            });

        },
        addAddonsIds(selectedAddons){
            this.form.addons=[];

            selectedAddons.forEach((addon)=>
            {
                this.form.addons.push(addon.id);
            });

        },
        addCategoriesIds(selectedCategories){
            this.form.categories=[];
            selectedCategories.forEach((category)=>
            {
                this.form.categories.push(category.id);
            });
        }

    },


}
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

<style >
.multiselect__tag{border: 1px solid #aaa;position:relative;display:inline-block;padding:4px 26px 4px 10px;border-radius:4px;margin-right:10px;color:black;line-height:1;background:#e4e4e4;margin-bottom:5px;white-space:nowrap;overflow:hidden;max-width:100%;text-overflow:ellipsis}</style>

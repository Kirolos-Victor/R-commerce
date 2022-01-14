<template>

    <tr>
        <td>{{ addonDetail.name_en }}</td>
        <td>{{ addonDetail.price}}</td>
        <td>{{ addondetailquantity }}</td>
    </tr>

</template>

<script>

export default {
    props:['addondetailid','addondetailquantity','itemquantity'],


    data(){
        return{
            addonDetail:{}
        }
    },
    methods:{
        loadAddonDetail(){
         axios.get('/vendor/cart/addon-detail/'+this.addondetailid).then((data)=>{
             this.addonDetail=data.data
             this.addonPrice=this.addonPrice + data.data.price;
         })
        }

    },
    created() {
        this.loadAddonDetail();
    },
    name: "ItemAddons"
}
</script>

<style scoped>

</style>

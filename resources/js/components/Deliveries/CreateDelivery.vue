<template>
    <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label >Select Branch</label>
                            <select id="branch" class="form-control" v-model="form.branch_id">
                                <option v-for="branch in this.branches" :value="branch.id">{{branch.name_en}}</option>
                            </select>
                            <div v-if="form.errors.has('branch_id')" v-html="form.errors.get('branch_id')" class="text-danger">
                            </div>

                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mt-4 mt-lg-0">
                        <div class="form-group mb-4">
                            <label >Select Country</label>
                            <select id="country" class="form-control" name="country" v-model="form.country_id">
                                <option v-for="country in this.countries" :value="country.id">{{country.name_en}}</option>

                            </select>
                            <div v-if="form.errors.has('country_id')" v-html="form.errors.get('country_id')" class="text-danger">                                    </div>

                    </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mt-4 mt-lg-0">
                        <div class="form-group mb-4">
                            <label for="delivery_time">Delivery Time <span class="text-danger">(Minutes)</span></label>
                            <input type="number" name="delivery_time" id="delivery_time" class="form-control input-mask" v-model="form.delivery_time" >
                            <div v-if="form.errors.has('delivery_time')" v-html="form.errors.get('delivery_time')" class="text-danger">
                            </div>
                    </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mt-4 mt-lg-0">
                        <div class="form-group mb-4">
                            <label for="delivery_fees">Delivery fees</label>
                            <input v-model="form.delivery_fees" type="text" name="delivery_fees" id="delivery_fees" class="form-control input-mask" >
                            <div v-if="form.errors.has('delivery_fees')" v-html="form.errors.get('delivery_fees')" class="text-danger">
                            </div>
                    </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mt-4 mt-lg-0">
                        <div class="form-group mb-4">
                            <label for="minimum_order">Minimum Order Price</label>
                            <input type="text" name="minimum_order" id="minimum_order" class="form-control input-mask" v-model="form.minimum_order_price">
                            <div v-if="form.errors.has('minimum_order_price')" v-html="form.errors.get('minimum_order_price')" class="text-danger">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mt-4 mt-lg-0">
                        <div class="form-group mb-4">
                            <label for="estimated_preparation_time">Estimated Preparation Time</label>
                            <input type="text" name="estimated_preparation_time" id="estimated_preparation_time" class="form-control input-mask" v-model="form.estimated_preparation_time">
                            <div v-if="form.errors.has('estimated_preparation_time')" v-html="form.errors.get('estimated_preparation_time')" class="text-danger">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="mt-4 mt-lg-0">
                        <div class="form-group mb-4">
                            <label for="delivery_hours">Delivery hours</label>
                            <div class="row mt-3" id="delivery_hours" v-for="(delivery,index) in deliveryHours">
                                <div class="col-3">
                                    <select  class="form-control" v-model="form.day[index]">
                                        <option value="everyday">Everyday</option>
                                        <option value="sunday">Sunday</option>
                                        <option value="monday">Monday</option>
                                        <option value="tuesday">Tuesday</option>
                                        <option value="wednesday">Wednesday</option>
                                        <option value="thursday">Thursday</option>
                                        <option value="friday">Friday</option>
                                        <option value="saturday">Saturday</option>
                                    </select>
                                    <div v-if="form.errors.has('day')" v-html="form.errors.get('day')" class="text-danger">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label>From: </label>
                                    <vue-timepicker format="hh:mm A" v-model="form.from[index]"></vue-timepicker>
                                    <div v-if="form.errors.has('from')" v-html="form.errors.get('from')" class="text-danger">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label>To: </label>
                                    <vue-timepicker format="hh:mm A" v-model="form.to[index]"></vue-timepicker>
                                    <div v-if="form.errors.has('to')" v-html="form.errors.get('to')" class="text-danger">
                                    </div>
                                </div>
                                <div class="col-1">
                                    <button class="btn btn-danger" @click.prevent="removeDeliveryHour(index)"><li class="bx bx-trash"></li></button>
                                </div>

                            </div>
                            <button class="btn btn-primary mt-3 center"@click.prevent="addMoreDeliveryHours()">Add More</button>

                        </div>
                    </div>
                </div>
                <div class="col-12">
                        <div class="mt-4 mt-lg-0">
                            <div class="form-group mb-4">
                                <label >Areas</label>

                                <multiselect track-by="id"
                                             :options="areas"
                                             v-model="selectedAreas"
                                             label="name_en"
                                             @input="addAreaId(selectedAreas)"
                                             :multiple="true"></multiselect>

                                <div v-if="form.errors.has('areas')" v-html="form.errors.get('areas')" class="text-danger">
                                </div>
                            </div>
                    </div>
                </div>
                <div class="col-12">
                    <gmap-autocomplete @place_changed="setPlace" class="form-input form-control"></gmap-autocomplete>
                    <GmapMap
                        :center="marker"
                        :zoom="7"
                        map-type-id="terrain"
                        style="width: 100%; height: 300px"
                    >
                        <gmap-marker :position="marker"  :draggable="false"  />
                        <GmapCircle

                            :center="marker"
                            :radius=form.radius
                            :visible="true"
                            :options="{fillColor:'red',fillOpacity:0.5}"
                        ></GmapCircle>

                    </GmapMap>
                </div>

                <div class="mt-3"><label for="customRange1" class="form-label">{{kilos}} Kilos</label>
<input id="customRange1" type="range"
       class="form-range"
       min="1" max="30" step="1"
       v-model.number="kilos"
       @change="updateRadius">
                </div>



            </div>
            <button type="button" class="btn btn-primary mt-2" @click.prevent="createDelivery">Create</button>

    </div>

</template>

<script>
// Main JS (in UMD format)
import VueTimepicker from 'vue2-timepicker'

// CSS
import 'vue2-timepicker/dist/VueTimepicker.css'
export default {
    props:['branches','countries','areas','routeCreateDelivery'],
    components: { VueTimepicker },
    data(){
        return{
            marker: { lat: 29.375859, lng: 47.9774052} ,
            kilos:1,
            deliveryHours:[0],
            selectedAreas:[],
            form: new Form({
                branch_id: '',
                country_id:'',
                delivery_time:'',
                delivery_fees:'',
                minimum_order_price:'',
                estimated_preparation_time:'',
                areas:[],
                area:"Kuwait City, Kuwait",
                longitude:29.375859,
                latitude:47.9774052,
                radius:1000,
                day:[],
                to: [''],
                from: [''],
            })

        }
    },
    methods:{
        updateRadius(){
            this.form.radius=this.kilos*1000;
        },

        setPlace(place) {
            this.form.area=place.formatted_address

            this.marker.lat= place.geometry.location.lat();
            this.marker.lng= place.geometry.location.lng();
            this.form.longitude=place.geometry.location.lng();
            this.form.latitude=place.geometry.location.lat();
        },

        addMoreDeliveryHours(){
            this.deliveryHours.push(1);
            this.form.to.push('');
            this.form.from.push('');

        },
        removeDeliveryHour(index){
            if(this.deliveryHours.length > 1)
            {
                this.deliveryHours.splice(index,1);
                this.form.day.splice(index,1);
                this.form.from.splice(index,1);
                this.form.to.splice(index,1);

            }
            else
            {
                alert('You must have at least one delivery hour')
            }
        },
        createDelivery(){
            this.form.post(this.routeCreateDelivery).then(()=>{
                window.location.href="/vendor/delivery?create-success"

            })

        },
        addAreaId(newAreas){
            this.form.areas=[];
            newAreas.forEach((area)=>{
                this.form.areas.push(area.id);
            })
        }
    },

    name: "CreateDelivery"
}
</script>

<style>

</style>

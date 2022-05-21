<template>
    <div class="container">
        <div class="mb-3">
            <label for="image" class="form-label">Select image for optimization</label>
            <input class="form-control" type="file" id="image" @change="(event) => { imageDetails.image = event.target.files[0] }" size="1000">
            <br>
            <button class="btn btn-success" type="submit" id="submit" @click.prevent="cropImage">Отправить</button>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    axios.defaults.headers.common["Authorization"] = "Bearer " + sessionStorage.getItem('accessToken');
    export default {
        name: "cropImage",
        data(){
            return {
                imageDetails: {
                    image:null
                }
            }
        },
        methods:{
            cropImage()
            {
                let form = new FormData();
                if(this.imageDetails.image != null)
                {
                    form.append('image', this.imageDetails.image);
                }
                try {
                    axios.post('/api/images/crop-image', form,{
                        headers: {
                            'accept': 'application/json',
                            'Accept-Language': 'en-US,en;q=0.8',
                            'Content-Type': `multipart/form-data`,
                        },
                        responseType: 'blob', // important
                    }).then((response) => {
                        const url = window.URL.createObjectURL(new Blob([response.data]));
                        const link = document.createElement('a');
                        link.href = url;
                        link.setAttribute('download', 'file.png'); //or any other extension
                        document.body.appendChild(link);
                        link.click();
                    });
                } catch (error) {
                    var errors = error.response;
                    console.log(errors);
                }
            }
        }
    }
</script>

<style scoped>

</style>

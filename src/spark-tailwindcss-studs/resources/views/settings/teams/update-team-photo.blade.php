<spark-update-team-photo :user="user" :team="team" inline-template>
    <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-grey-light card-default" v-if="user">
        <div class="py-3 px-6 mb-0 bg-grey-lighter border-b-1 border-grey-light text-grey-darkest">
            {{__('teams.team_photo')}}
        </div>

        <div class="flex-auto p-6">
            <div class="relative px-3 py-3 mb-4 border rounded text-red-darker border-red-dark bg-red-lighter" v-if="form.errors.has('photo')">
                @{{ form.errors.get('photo') }}
            </div>

            <form role="form">
                <div class="mb-4 flex flex-wrap justify-center">
                    <div class="md:w-1/2 pr-4 pl-4 flex align-center">
                        <div class="image-placeholder mr-4">
                            <span role="img" class="profile-photo-preview" :style="previewStyle"></span>
                        </div>
                        <div class="spark-uploader mr-4">
                            <input ref="photo" type="file" class="spark-uploader-control" name="photo" @change="update" :opacity-75="form.busy">
                            <div class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline text-black-dark border-black bg-white hover:bg-black-light hover:text-black-darker">{{__('Update Photo')}}</div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</spark-update-team-photo>

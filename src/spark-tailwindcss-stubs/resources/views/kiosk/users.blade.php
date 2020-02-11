<spark-kiosk-users :user="user" inline-template>
    <div>
        <div v-show=" ! showingUserProfile">
            <!-- Search Field card -->
            <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-grey-light card-default" style="border: 0;">
                <div class="flex-auto p-6">
                    <form role="form" @submit.prevent>
                        <!-- Search Field -->
                        <input type="text" id="kiosk-users-search" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded"
                                name="search"
                                placeholder="{{__('Search By Name Or E-Mail Address...')}}"
                                v-model="searchForm.query"
                                @keyup.enter="search">
                    </form>
                </div>
            </div>

            <!-- Searching -->
            <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-grey-light card-default" v-if="searching">
                <div class="py-3 px-6 mb-0 bg-grey-lighter border-b-1 border-grey-light text-grey-darkest">{{__('Search Results')}}</div>

                <div class="flex-auto p-6">
                    <i class="fa fa-btn fa-spinner fa-spin"></i> {{__('Searching')}}
                </div>
            </div>

            <!-- No Search Results -->
            <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-grey-light card-default" v-if=" ! searching && noSearchResults">
                <div class="py-3 px-6 mb-0 bg-grey-lighter border-b-1 border-grey-light text-grey-darkest">{{__('Search Results')}}</div>

                <div class="flex-auto p-6">
                    {{__('No users matched the given criteria.')}}
                </div>
            </div>

            <!-- User Search Results -->
            <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-grey-light card-default" v-if=" ! searching && searchResults.length > 0">
                <div class="py-3 px-6 mb-0 bg-grey-lighter border-b-1 border-grey-light text-grey-darkest">{{__('Search Results')}}</div>

                <div class="block w-full overflow-auto scrolling-touch">
                    <table class="w-full max-w-full mb-4 bg-transparent table-valign-middle mb-0">
                        <thead>
                            <tr>
                                <th></th>
                                <th>{{__('Name')}}</th>
                                <th>{{__('E-Mail Address')}}</th>
                                <th class="th-fit"></th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr v-for="searchUser in searchResults">
                                <!-- Profile Photo -->
                                <td>
                                    <img :src="searchUser.photo_url" class="spark-profile-photo" alt="{{__('User Photo')}}" />
                                </td>

                                <!-- Name -->
                                <td>
                                    <div>
                                        @{{ searchUser.name }}
                                    </div>
                                </td>

                                <!-- E-Mail Address -->
                                <td>
                                    <div>
                                        @{{ searchUser.email }}
                                    </div>
                                </td>

                                <td>
                                    <!-- View User Profile -->
                                    <button class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline btn-default" @click="showUserProfile(searchUser)">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- User Profile Detail -->
        <div v-show="showingUserProfile">
            @include('spark::kiosk.profile')
        </div>
    </div>
</spark-kiosk-users>

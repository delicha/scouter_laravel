<div class="flex mb-4" x-data="picturePreview()">
    <div class="mr-3">
        
        <div id="preview_sub"></div>

        @if(Auth::user()->sub_image)
            <img
                id="preview"
                src="{{ asset('storage/' . Auth::user()->sub_image) }}"
                alt=""
                class="w-16 h-16 rounded-full object-cover border-none bg-gray-200">
        @else
            <img
                id="preview"
                src="{{ asset('img/default_profile_img.png') }}"
                alt=""
                class="w-16 h-16 rounded-full object-cover border-none bg-gray-200">
        @endif
    </div>
    <div class="flex items-center">
        <button
                x-on:click="document.getElementById('sub_image').click()"
                type="button"
                class="inline-flex items-center uppercase rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            サブ画像を選択
        </button>
        <input @change="showPreview(event)" type="file" name="sub_images[]" id="sub_image" class="hidden" multiple>

        <script>
            function picturePreview() {
                return {
                    showPreview: (event) => {
                        const previewEl = document.getElementById('preview_sub');
                        previewEl.innerHTML = ''; // 一旦子要素を全削除

                        if (event.target.files.length > 0) {
                            for (let i = 0; i < event.target.files.length; i++) {
                            const src = URL.createObjectURL(event.target.files[i]);
                            const img = document.createElement('img');
                            img.src = src;
                            img.classList.add('w-16', 'h-16', 'rounded-full', 'object-cover', 'border-none', 'bg-gray-300');
                            previewEl.appendChild(img);
                            console.log(previewEl.appendChild(img))
                            }
                        }
                    },
                };
            }

        </script>
        
    </div>
</div>

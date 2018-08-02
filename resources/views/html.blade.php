<div class="form-group">
    <input id="image" name="image[]" type="file" multiple>
    <input type="hidden" name="image_id" value="">
</div>

<script>
    let image = $("#image").fileinput({
        language: 'zh',
        uploadUrl: "{{ route('fileinput.server') }}?chunk=product",
        uploadAsync: false,
        showUpload: false, // hide upload button
        showRemove: false, // hide remove button
        minFileCount: 1,
        maxFileCount: 5,
        overwriteInitial: false,
        initialPreview: [],
        initialPreviewAsData: true, // identify if you are sending preview data only and not the raw markup
        initialPreviewFileType: 'image', // image is the default and can be overridden in config below
        initialPreviewConfig: [],
        purifyHtml: true, // this by default purifies HTML data for preview
        // uploadExtraData: {
        //     img_key: "1000",
        //     img_keywords: "happy, places"
        // }
    }).on("filebatchselected", function (event, files) {
        image.fileinput("upload");
    }).on('filesorted', function (e, params) {
        let image_id = [];
        for (i in params.stack) {
            image_id.push(params.stack[i]['key']);
        }
        $('input[name="image_id"]').val(image_id);
    }).on('filebatchuploadsuccess', function (e, params) {
        let image_id = $('input[name="image_id"]').val();
        let add_image_id = params.jqXHR.responseJSON.image_id.join(',');

        $('input[name="image_id"]').val(image_id + ',' + add_image_id);
    }).on('filedeleted', function (e, params) {
        console.log('File uploaded params', params);
    });
</script>
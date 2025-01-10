<!-- TinyMCE -->
@props(["selector"=>""])

@php
$lang = strtoupper(App::getLocale()) === "ZH_CN" ? "zh_CN" : "en";
@endphp

@if($selector)
    @push('after-scripts')
    <script src="{{ asset('vendor/tinymce/tinymce.min.js') }}"></script>
    <script type="module">
        tinymce.init({
            selector: '{{$selector}}',
            language: '{{$lang}}',
            min_height: 400,
            plugins: [
                'print',
                'preview',
                'searchreplace',
                'autolink',
                'directionality',
                'visualblocks',
                'visualchars',
                'fullscreen',
                'image',
                'link',
                'media',
                'template',
                'code',
                'codesample',
                'table',
                'charmap',
                'hr',
                'pagebreak',
                'nonbreaking',
                'anchor',
                'insertdatetime',
                'advlist',
                'lists',
                'wordcount',
                'textpattern',
                'emoticons',
                'autosave',
                'help',
            ],
            toolbar_sticky: true,
            toolbar: 'code undo redo restoredraft | forecolor backcolor bold italic underline strikethrough link anchor | alignleft aligncenter alignright alignjustify outdent indent lineheight | styleselect formatselect fontselect fontsizeselect | bullist numlist | blockquote subscript superscript removeformat | table image media charmap emoticons hr pagebreak insertdatetime print preview | fullscreen',
            fontsize_formats: '12px 14px 16px 18px 24px 36px 48px 56px 72px',
            font_formats: 'Microsoft YaHei,Helvetica Neue,PingFang SC,sans-serif;PingFang SC,Microsoft YaHei,sans-serif;simsun,serif;FangSong,serif;SimHei,sans-serif;Arial=arial,helvetica,sans-serif;Arial Black=arial black,avant garde;Book Antiqua=book antiqua,palatino;',
            link_list: [],
            image_list: [],
            init_instance_callback: function (editor) {
                const textarea = document.querySelector('{{$selector}}');
                editor.on('change', (e) => {
                    textarea.innerHTML = editor.getContent();
                });
                editor.on('input', (e) => {
                    textarea.innerHTML = editor.getContent();
                });
                editor.on('paste', (e) => {
                    textarea.innerHTML = editor.getContent();
                });
                editor.on('ExecCommand', (e) => {
                    textarea.innerHTML = editor.getContent();
                });
            },
            file_picker_callback: function (callback, value, meta) {
                if (meta.filetype === 'file') {
                //   callback('/img/bd_logo1.png', { text: 'My text' });
                }
                if (meta.filetype === 'image') {
                //   callback('/img/bd_logo1.png', { alt: 'My alt text' });
                }
                if (meta.filetype === 'media') {
                //   callback('movie.mp4', { source2: 'alt.ogg', poster: '/img/bd_logo1.png' });
                }
            },
        });
    </script>
    @endpush
@endif
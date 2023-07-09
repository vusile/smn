<h2><a href="/admin/mkeka">Rudi kwenye mkeka</a></h2>
<button class="btn" >Copy Message!</button>
<br />
<br />
<div style="color: seagreen; font-weight: bold; font-size: 24px" id="success"></div>
<div style="color: red; font-weight: bold; font-size: 24px" id="failure"></div>
<div id = "message" style="display: none">
    {!! urldecode( $message) !!}
</div>

<script>
    // function fallbackCopyTextToClipboard(text) {
    //     var textArea = document.createElement("textarea");
    //     textArea.value = text;
    //
    //     // Avoid scrolling to bottom
    //     textArea.style.top = "0";
    //     textArea.style.left = "0";
    //     textArea.style.position = "fixed";
    //
    //     document.body.appendChild(textArea);
    //     textArea.focus();
    //     textArea.select();
    //
    //     try {
    //         var successful = document.execCommand('copy');
    //         var msg = successful ? 'successful' : 'unsuccessful';
    //         console.log('Fallback: Copying text command was ' + msg);
    //         document.getElementById('success').innerHTML = "Umefanikiwa kucopy";
    //         document.getElementById('failure').innerHTML = ""
    //     } catch (err) {
    //         console.error('Fallback: Oops, unable to copy', err);
    //         document.getElementById('failure').innerHTML = "Kuna shida. Mtaarifu admin!";
    //         document.getElementById('success').innerHTML = ""
    //     }
    //
    //     document.body.removeChild(textArea);
    // }
    // function copyTextToClipboard(text) {
    //     if (!navigator.clipboard) {
    //         fallbackCopyTextToClipboard(text);
    //         return;
    //     }
    //     navigator.clipboard.writeText(text).then(function() {
    //         console.log('Async: Copying to clipboard was successful!');
    //         document.getElementById('success').innerHTML = "Umefanikiwa kucopy";
    //         document.getElementById('failure').innerHTML = ""
    //     }, function(err) {
    //         console.error('Async: Could not copy text: ', err);
    //         document.getElementById('failure').innerHTML = "Kuna shida. Mtaarifu admin!";
    //         document.getElementById('success').innerHTML = ""
    //     });
    // }

    var copyBtn = document.querySelector('.btn');

    copyBtn.addEventListener('click', function(event) {
        let text = document.getElementById('message').innerHTML
        // console.log(text)
        copyToClipboard((text));
    });

    function copyToClipboard(html) {
        var container = document.createElement('div')
        container.innerHTML = html
        container.style.position = 'fixed'
        container.style.pointerEvents = 'none'
        container.style.opacity = 0
        document.body.appendChild(container)
        window.getSelection().removeAllRanges()
        var range = document.createRange()
        range.selectNode(container)
        window.getSelection().addRange(range)
        document.execCommand('copy')
        document.body.removeChild(container);
        alert("Copied")
    }

</script>


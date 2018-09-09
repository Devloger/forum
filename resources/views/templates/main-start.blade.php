<main class="container main pb-0">
    <div class="row container-first">
        <div class="col-lg-9 col-md-12">
            <nav class="breadcrumb">
                @foreach($breadcrumbs as $breadcrumb)
                    @if($loop->last)
                        <span class="breadcrumb-item active" href="#">{{ $breadcrumb }}</span>
                    @else
                        <span class="breadcrumb-item" href="#">{{ $breadcrumb }}</span>
                    @endif
                @endforeach
            </nav>
        </div>
        <div class="col-lg-3 col-md-12 my-auto">
            <div class="float-lg-right text-center social">
                <a data-site="" class="ssba_facebook_share" href="http://www.facebook.com/sharer.php?u={{ url()->current() }}" target="_blank"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgBAMAAACBVGfHAAAAKlBMVEUAAAAtSbwtSLktSbotSLotSbksSbotSbouR7gtSbwtSLosSbotSrstSboS9HY+AAAADXRSTlMAFrDnldGQ+D0uuGJPu92a0gAAAJNJREFUKM9jYBCJvQsHVx0ZGDhs7yKByw0MwndRgCGDL6rAFYZYVIGrDEhsJSWgeQiBagEGBl0kgcsTGFAF7jCgCSxAF9iALjCBgaW8/C6SAAMDO4RGCPAiC7ilMTCwpaUhHAZ0FNhQSgQmCjIwMAoKrsWwlm4CsagCVxl8UQWuMAijChiCIxshcLkBlBxgAuDkAADGrUgALjpTjwAAAABJRU5ErkJggg==" alt="Udostępnij stronę na Facebook'u!" /></a>
                <a data-site="" class="ssba_twitter_share" href="http://twitter.com/share?url={{ url()->current() }}" target="_blank"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAMAAABEpIrGAAAAPFBMVEUAAAA7tL86tL86s8A7tL87tL87tL87tMA5tb46srs5tr46tb87tL86tcA7tL87tcA7tcA7tL88tcA7tL9lowQXAAAAE3RSTlMA6bJl9sDhfiMaEFRFN9e5opuNCmoYMgAAAL9JREFUOMudk0kOwyAMRT/gACEhE/e/a6kIqgwplvI2LPyQLQ/IGK3SA0obfJmn9JdpBsDinQGYNMRAjwUNNRYUksAbwR6HzQ9xgc4ad8i4Kyou7DB0l11wOxdOoPxZUYhNig1AcDm3R0G1RS5lMGsocZ8aQa9gLK1AAQzX9cGBoftGTR4/PPUCK2JPvWADL7GfBR2+JrCPwrbU/7UA3ocZN+fzuDcTAxDiZQf7oOjFRolLK669eDjS6cnHK57/B65kOuZqKjgfAAAAAElFTkSuQmCC" alt="Udostępnij stronę na Twitter!"  /></a>
                <a data-site="" class="ssba_google_share" href="https://plus.google.com/share?url={{ url()->current() }}" target="_blank"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAMAAABEpIrGAAAASFBMVEUAAADjOzvkOzvkOjrjOzvkOjrjOjrkOzvkOzveQ0PjOzvjOzvkOzvkOzvjOzvkOzvkOzvjOzvkOzvkOTnkOzviOzvkPDzjOzsMy3mtAAAAF3RSTlMAweRl8SizHEIHqI1wVdOWgntNN54RXVH2E2YAAADjSURBVDjLhZNZjsQgDEQLMDtkT3P/m05Qhh5NtwPvI1asp9hEFC6UkYVBGoWKFeURYQGI0kEAqnRRMH3BQPYFib9xyenKx8wmUN7FlIA4FV7YPF3PFV7cbXwIAq4W8lC8sGL7PZXmhQUn1XrAPY3AXGtELHjzb0no+ondlQeBXtBB5J0KO6IyBQVQ4YTGDExdQXpo+SiQickCVvK/mtZTCSmDvQxWcF7c4o7ICSvSe4/MCRpHa1jHC6rtioUTZiDc71kTu+Rxws0mLHb7OmZrmJTda/kKiRxe+2FwRtEbh3cY/x9hvUrgjpLWagAAAABJRU5ErkJggg==" alt="Udostępnij stronę na Google+'!"  /></a>
            </div>
        </div>
    </div>
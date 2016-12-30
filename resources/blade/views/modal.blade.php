<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="modalDialogTitle">{{$modal['title']}}</h4>
  </div>
  <div id="modalContent">
    <div class="modal-body">
      @yield('placeholder')
    </div>
  </div>
  <div class="modal-footer">
    <button class="btn btn-default" data-dismiss="modal">Close</button>
    <button class="btn btn-primary" onclick="{{$modal['btn']['onclick']}}">{{$modal['btn']['title']}}</button>
  </div>
</div>

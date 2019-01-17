<div id="colors" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Цвета</h4>
            </div>
            <div class="modal-body">
                    <div class="row">
                        @foreach($colors as $k=>$color)
                            <div class="col-md-4 color-box" data-variant="" data-id="{{ $color->id }}">
                                <p>
                                    <span class="label" style="background:{{ $color->value }};border-radius:35%">&nbsp;&nbsp;&nbsp;</span>
                                    <strong>{{ $color->name }}</strong>
                                </p>
                            </div>
                        @endforeach
                    </div>           
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-toggle="modal" data-target="#create-color"><i class="fa fa-plus"></i> Добавить новый</button>
            </div>
            </div>
        
        </div>
    </div>
    
    <div id="create-color" class="modal fade" role="dialog">
      <div class="modal-dialog">
    
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Добавить цвет</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form id="add-color" action="{{route('admin.ajax.color.store')}}" method="POST">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Название*</label>
                                <input type="text" class="form-control" id="name" name="name" value="" placeholder="Название">       
                                <span class="help-block"></span>                        
                            </div>
                            <div class="form-group">
                                <label for="value" >Значение*:</label>
                                <input type="text" id="value" name='value' class="coloringpick" value="">
                                <span class="help-block"></span>
                            </div>
                            <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Сохранить</button>                           
                        </div>
                    </form>
                </div>           
            </div>
        </div>
    
      </div>
    </div>
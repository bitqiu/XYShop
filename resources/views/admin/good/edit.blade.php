@extends('admin.right')

@section('content')
<form action="javascript:;" method="post" id="form_ajax">
    {{ csrf_field() }}
    <table class="table table-striped">
        <input type="hidden" name="ref" value="{!! $ref !!}">
        <input type="hidden" name="goods_id" value="{{ $info->id }}">
        <tr>
            <td class="td_left">选择分类：</td>
            <td>
                <select name="" id="catid_one" onchange="get_goodcate(this.value,'catid_two',0)" class="form-control input-sm">
                    <option value="0">顶级分类</option>
                </select>
                <select name="" id="catid_two" onchange="get_goodcate(this.value,'catid',0);get_brand(document.getElementById('catid_one').value,this.value,'brand_id',0)" class="form-control input-sm">
                    <option value="0">二级分类</option>
                </select>
                <select name="data[cate_id]" id="catid" class="form-control input-sm">
                    <option value="0">三级分类</option>
                </select>
                <p class="input-info"><span class="color_red">*</span>必填，商品归哪个分类</p>
            </td>
        </tr>

        <tr>
            <td class="td_left">选择品牌：</td>
            <td>
                <select name="data[brand_id]" id="brand_id" class="form-control input-sm">
                    <option value="0">选择品牌</option>
                </select>
                <p class="input-info">商品归哪个品牌</p>
            </td>
        </tr>

        <tr>
            <td class="td_left">商品标题：</td>
            <td>
                <input type="text" name="data[title]" value="{{ $info->title }}" class="form-control input-sm">
                <p class="input-info"><span class="color_red">*</span>不超过255字符</p>
            </td>
        </tr>

        <tr>
            <td class="td_left">商品编码：</td>
            <td>
                <input type="text" name="data[pronums]" value="{{ $info->pronums }}" class="form-control input-sm">
                <p class="input-info"><span class="color_red">*</span></p>
            </td>
        </tr>

        <tr>
            <td class="td_left">市场价：</td>
            <td>
                <input type="text" name="data[market_price]" value="{{ $info->market_price }}" class="form-control input-sm">
                <p class="input-info"><span class="color_red">*</span>数字</p>
            </td>
        </tr>

        <tr>
            <td class="td_left">成本价：</td>
            <td>
                <input type="text" name="data[cost_price]" value="{{ $info->cost_price }}" class="form-control input-sm">
                <p class="input-info"><span class="color_red">*</span>数字</p>
            </td>
        </tr>

        <tr>
            <td class="td_left">本店价：</td>
            <td>
                <input type="text" name="data[shop_price]" value="{{ $info->shop_price }}" class="form-control input-sm">
                <p class="input-info"><span class="color_red">*</span>数字</p>
            </td>
        </tr>

        <tr>
            <td class="td_left">库存：</td>
            <td>
                <input type="text" name="data[store]" value="{{ $info->store }}" class="form-control input-sm">
                <p class="input-info"><span class="color_red">*</span>数字</p>
            </td>
        </tr>
        
        <tr>
            <td class="td_left">单件重量：</td>
            <td>
                <input type="text" name="data[weight]" value="{{ $info->weight }}" class="form-control input-sm">
                <p class="input-info"><span class="color_red">*</span>数字，单位：克</p>
            </td>
        </tr>
        
        <tr>
            <td class="td_left">推荐：</td>
            <td>
                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-xs btn-info @if($info->is_pos == '1') active @endif">
                        <input type="radio" name="data[is_pos]" autocomplete="off" @if($info->is_pos == '1') checked @endif value="1"> 显示
                    </label>
                    <label class="btn btn-xs btn-info @if($info->is_pos == '0') active @endif">
                        <input type="radio" name="data[is_pos]" autocomplete="off" @if($info->is_pos == '0') checked @endif value="0"> 隐藏
                    </label>
                </div>
            </td>
        </tr>

        <tr>
            <td class="td_left">新品：</td>
            <td>
                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-xs btn-info @if($info->is_new == '1') active @endif">
                        <input type="radio" name="data[is_new]" autocomplete="off" @if($info->is_new == '1') checked @endif value="1"> 显示
                    </label>
                    <label class="btn btn-xs btn-info @if($info->is_new == '0') active @endif">
                        <input type="radio" name="data[is_new]" autocomplete="off" @if($info->is_new == '0') checked @endif value="0"> 隐藏
                    </label>
                </div>
            </td>
        </tr>

        <tr>
            <td class="td_left">热卖：</td>
            <td>
                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-xs btn-info @if($info->is_hot == '1') active @endif">
                        <input type="radio" name="data[is_hot]" autocomplete="off" @if($info->is_hot == '1') checked @endif value="1"> 显示
                    </label>
                    <label class="btn btn-xs btn-info @if($info->is_hot == '0') active @endif">
                        <input type="radio" name="data[is_hot]" autocomplete="off" @if($info->is_hot == '0') checked @endif value="0"> 隐藏
                    </label>
                </div>
            </td>
        </tr>

        <tr>
            <td class="td_left">关键字：</td>
            <td>
                <input type="text" name="data[keyword]" value="{{ $info->keyword }}" class="form-control input-md">
            </td>
        </tr>


        <tr>
            <td class="td_left">描述：</td>
            <td>
                <textarea name="data[describe]" class="form-control" rows="5">{{ $info->describe }}</textarea>
            </td>
        </tr>
        
        <tr>
            <td class="td_left">缩略图：</td>
            <td>
                <div class="clearfix thumb_btn">
                    <input type="text" readonly="readonly" name="data[thumb]" id="url3" value="{{ $info->thumb }}" class="form-control input-sm">
                    <div value="选择图片" id="image3"></div>
                </div>
                <p class="input-info"><span class="color_red">*</span>图片类型jpg/jpeg/gif/png，大小不超过2M</p>
                <img src="{{ $info->thumb }}" class="thumb-src mt10 img-responsive" width="300" alt="">
            </td>
        </tr>
        

        <tr>
            <td class="td_left">内容：</td>
            <td>
                <textarea name="data[content]" class="form-control" id="editor_id">{!! $info->content !!}</textarea> 
                <p class="input-info"><span class="color_red">*</span></p>
            </td>
        </tr>

        <tr>
            <td class="td_left">产品规格：</td>
            <td>
                <div id="good_spec" class="form-group"></div>
            </td>
        </tr>

        <tr>
            <td class="td_left">产品属性：</td>
            <td>
                <div id="good_attr" class="form-group"></div>
            </td>
        </tr>

        <script>
            $(function(){
                // 修改产品分类时，取出对应的属性及规格
                
            })
        </script>

        <tr>
            <td class="td_left">排序：</td>
            <td>
                <input type="text" name="data[sort]" value="{{ $info->sort }}" class="form-control input-xs">
                <p class="input-info"><span class="color_red">*</span>越大越靠前</p>
            </td>
        </tr>

        <tr>
            <td></td>
            <td>

                <div class="btn-group">
                    <button type="reset" name="reset" class="btn btn-xs btn-warning">重填</button>
                    <div onclick='ajax_submit_form("form_ajax","{{ url('/console/good/edit',['id'=>$info->id]) }}")' name="dosubmit" class="btn btn-xs btn-info">提交</div>
                </div>
                
            </td>
        </tr>


    </table>

</form>


<script>
    $(function(){
        get_goodcate(0,'catid_one',"{{ $info->goodcate_one_id }}");
        get_goodcate("{{ $info->goodcate_one_id }}",'catid_two',"{{ $info->goodcate_two_id }}");
        get_goodcate("{{ $info->goodcate_two_id }}",'catid',"{{ $info->cate_id }}");
        get_brand("{{ $info->goodcate_one_id }}","{{ $info->goodcate_two_id }}",'brand_id',"{{ $info->brand_id }}")
        // 修改产品分类时，取出对应的属性及规格
        $('#catid').on('change',function() {
            var cid = $('#catid').val();
            var attr_url = "{{url('/console/good/goodattr')}}";
            var spec_url = "{{url('/console/good/goodspec')}}";
            var good_id = $("input[name='goods_id']").val();
            // 属性
            $.get(attr_url,{'cid':cid,'good_id':good_id},function(d){
                $("#good_attr").html(d);
            });
            // 规格
            $.get(spec_url,{'cid':cid,'good_id':good_id},function(d){
                $("#good_spec").html(d);
            });
        });

        // 初始化属性及规格
        var cid = $('#catid').val();
        var attr_url = "{{url('/console/good/goodattr')}}";
        var spec_url = "{{url('/console/good/goodspec')}}";
        var good_id = $("input[name='goods_id']").val();
        // 属性
        $.get(attr_url,{'cid':cid,'good_id':good_id},function(d){
            $("#good_attr").html(d);
        });
        // 规格
        $.get(spec_url,{'cid':cid,'good_id':good_id},function(d){
            $("#good_spec").html(d);
            ajaxGetSpecInput(); // 触发完  马上触发 规格输入框
        });
    })

	// 上传时要填上sessionId与csrf表单令牌，否则无法通过验证
	KindEditor.ready(function(K) {
		window.editor = K.create('#editor_id',{
			minHeight:350,
			uploadJson : "{{ url('console/attr/uploadimg') }}",
            extraFileUploadParams: {
				session_id : "{{ session('console')->id }}",
            },
            afterCreate : function() {this.sync();}, 
            afterBlur: function(){this.sync();}
		});
		var uploadbutton = K.uploadbutton({
            button : K('#image3')[0],
            fieldName : 'imgFile',
            url : "{{ url('console/attr/uploadimg') }}",
            extraFileUploadParams: {
                session_id : "{{ session('console')->id }}",
            },
            afterUpload : function(data) {
                if (data.error === 0) {
                    var url = K.formatUrl(data.url, 'absolute');
                    K('#url3').val(url);
                    $('.thumb-src').attr('src',url).removeClass('hidden');
                } else {
                    alert(data.message);
                }
            },
            afterError : function(str) {
                alert('自定义错误信息: ' + str);
            }
        });
        uploadbutton.fileBox.change(function(e) {
            uploadbutton.submit();
        });
		
	});
</script>

@endsection
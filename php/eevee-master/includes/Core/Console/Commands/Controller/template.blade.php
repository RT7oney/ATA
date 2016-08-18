
namespace Core\Models\{{  ModelNamespacePath }};

use Core\Models\Model;
use Core\Models\Permission;
use Illuminate\Support\Facades\Validator;

class {{  ModelName }} {

    // 初始化{{ ModelName }}记录
    protected static function initialize{{ ModelName }}($data){

        $initialized = [
            'id' => Model::id(),
            'type' => '',
            'status' => '',
        ];

        Model::timestamps($initialized, true);

        return array_merge($initialized, $data);
    }

    // {{ ModelName }}数据校验
    protected static function validate{{ ModelName }}(array $data, array $ignore = []){

        $table = Model::table('{{ ModelNameToLower }}');

        // 数据验证规则: http://doc.eevee.io/validation.html

        $rule = [

        ];

        Model::ignore($data,$ignore);

        $validator = Validator::make($data, $rule);

        if($validator->fails()) {

            exception('validateFailed', $validator->errors());
        }

    }

    // 获取{{ ModelName }}
    protected static function get{{ ModelName }}(${{ ModelNameToLower }}_id){

        if($data = Model::resource('{{ ModelNameToLower }}')->where(${{ ModelNameToLower }}_id)->first()){

            Permission::guard((array)$data, true);

            return status('success',$data);
        }

        exception('{{ ModelNameToLower }}DoesNotExist');
    }

    // 获取{{ ModelName }}组
    protected static function get{{ ModelName }}s(array $params){

        $data = Model::selector('${{ ModelNameToLower }}', $params);

        Permission::guard($data, true);

        return status('success', $data);
    }

    // 添加{{ ModelName }}记录
    protected static function add{{ ModelName }}(array $data){

        Permission::guard($data);

        self::validate{{ ModelName }}($data);

        $data = self::initialize{{ ModelName }}($data);

        return Model::transaction(function() use($data){

            Model::filter($data, Model::fields('{{ ModelNameToLower }}'));

            Model::resource('{{ ModelNameToLower }}')->insert($data);

            $status = self::get{{ ModelName }}($data['id']);

            return $status;

        });

    }

    // 更新{{ ModelName }}记录
    protected static function update{{ ModelName }}(${{ ModelNameToLower }}_id, $data){

        Permission::guard($data);

        $origin = self::get{{ ModelName }}(${{ ModelNameToLower }}_id)->data;

        $ignore = [

        ];

        self::validate{{ ModelName }}($data, $ignore);

        return Model::transaction(function() use($data){

            Model::filter($data, Model::fields('{{ ModelNameToLower }}'));

            Model::resource('{{ ModelNameToLower }}')->where('{{ ModelNameToLower }}_id')->update($data);

            $status = self::get{{ ModelName }}($data['id']);

            return $status;

        });

    }

    // 删除{{ ModelName }}记录
    protected static function delete{{ ModelName }}(${{ ModelNameToLower }}_id){

        $origin = self::get{{ ModelName }}(${{ ModelNameToLower }}_id)->data;

        Permission::guard((array)$origin, true);

        Model::resource('{{ ModelNameToLower }}')->where('{{ ModelNameToLower }}_id')->delete();

        return status('success');
    }
}


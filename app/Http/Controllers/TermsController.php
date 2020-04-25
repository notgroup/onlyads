<?php

namespace App\Http\Controllers;
use Laravel\Lumen\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\EavAttribute;
use App\Models\EavGroup;
use App\Models\Entity;
use App\Models\Term;
use App\Models\TermEntity;
use App\Models\TermVariant;
use Illuminate\Support\Str;




class TermsController extends Controller
{

    public function getTerms(Request $request)
    {
        $termTaxonomyIds = DB::table('term_variant')
        ->select(['term_variant.*', 'terms.*', 'entities.type_code as entity_type_code', 'entities.id as entity_type_id','entities.entity_code as entity_code'])
        //->where('term_type_id', $type_id)
        ->leftJoin('entities', 'term_variant.term_type_id', '=', 'entities.id')
        ->leftJoin('terms', 'term_variant.term_id', '=', 'terms.term_id')
        ->get()->toArray();

       /* $termTaxonomyIds = DB::table('term_variant')->selectRaw("JSON_UNQUOTE(JSON_EXTRACT(attr, '$.marka')) as marka, count(JSON_EXTRACT(attr, '$.marka'))")->where('term_type_id', $type_id)
       ->get();*/
       return response()->json($termTaxonomyIds);
    }


    public function addTaxonomy(Request $request)
    {
        $termTaxonomyIds = $this->insertTermVariant($request->termTypeId, $request->termName, $request->parent_id);

       /* $termTaxonomyIds = DB::table('term_variant')->selectRaw("JSON_UNQUOTE(JSON_EXTRACT(attr, '$.marka')) as marka, count(JSON_EXTRACT(attr, '$.marka'))")->where('term_type_id', $type_id)
       ->get();*/
       return response()->json([$termTaxonomyIds]);
    }


    public function getTermsWithType(Request $request, $type_id)
    {
        $termTaxonomyIds = DB::table('term_variant')
        ->where('term_type_id', $type_id)
        ->where('parent_id', 0)
        ->leftJoin('terms', 'term_variant.term_id', '=', 'terms.term_id')
        ->get();

       /* $termTaxonomyIds = DB::table('term_variant')->selectRaw("JSON_UNQUOTE(JSON_EXTRACT(attr, '$.marka')) as marka, count(JSON_EXTRACT(attr, '$.marka'))")->where('term_type_id', $type_id)
       ->get();*/
       return response()->json($termTaxonomyIds);
    }

    public function getTermsWithTypeSub(Request $request, $type_id, $catId)
    {

        $catId = $catId ?: 9293;

        $parent = TermVariant::where('term_type_id', $type_id)
            ->where('variant_id', $catId)
            ->first();


        $termTaxonomyIds = DB::table('term_variant')
        ->leftJoin('terms', 'term_variant.term_id', '=', 'terms.term_id')
        ->where('term_variant.term_type_id', $type_id);
                if (!$catId) {
        }
        $termTaxonomyIds->where('parent_id', $catId)->orWhere('variant_id', $parent->variant_id)->orWhere('variant_id', $parent->parent_id);
        /*else {

        $termTaxonomyIds->whereRaw("term_variant.path glob '*$catId*'");
        }*/
        $termTaxonomyIds = $termTaxonomyIds->orderBy('level')->get();

       /* $termTaxonomyIds = DB::table('term_variant')->selectRaw("JSON_UNQUOTE(JSON_EXTRACT(attr, '$.marka')) as marka, count(JSON_EXTRACT(attr, '$.marka'))")->where('term_type_id', $type_id)
       ->get();*/
$test02 = EavGroup::select(['attribute_group_id','attribute_group_code','attribute_group_name'])->where('entity_type_id', 30)->whereIn("attribute_group_id", $parent->getSearchGroupJson())->get()->toArray();

       return response()->json($termTaxonomyIds);
    }

    public function getEntityAsTerm(Request $request, $type_id, $term_id, $entry_type_id)
    {
        $termVariant = TermVariant::where('entity_type_id', $type_id)
            ->where('variant_id', $term_id)
            ->first()
            ->termEntity()
            ->where('entity_type_id', $entry_type_id)
            ->setJoinEntity()
            ->get();

        return response()->json($termVariant);
    }





    public function insertTermVariant($term_type_id, $term_name, $parent_id = 0, $level = 0, $path = '')
    {
        //$parent_id = 0;
        //$level = 0;
        //$count = 0;
        $term = $this->insertTermValue($term_name);
        $termId = $term->term_id;

        $termTax = TermVariant::where('term_id', $termId)->where('term_type_id', $term_type_id)->first();
        if (!$termTax) {
            $termTax = TermVariant::create(['term_type_id' => $term_type_id, 'term_id' => $termId, 'parent_id' => $parent_id, 'level' => $level, 'path' => '']);
            //$termTax->save();
        }

            $termTax->path = implode('/', $termTax->getPathText());
            $termTax->save();
        return $termTax->variant_id;
    }

    public function insertTermValue($term_name)
    {
        $term = Term::firstOrNew(['name' => $term_name, 'slug' => Str::slug($term_name)]);
        if (!$term->term_id) {
            $term->save();
        }
        return $term;
    }

    public function termEntityTest()
    {
        $term = TermVariant::with(['term', 'parent'])->find(760);

        $response = ['term' => $term];
        $response['entities'] = $term->termEntity()->limit(1)->get();
        $response['parent'] = $term->getParentIds();
        return $response;
    }
    public function entityTermsTest()
    {
        $entity = Entity::find(10);

        $response = [];
        $response['entity'] = $entity;
        $response['terms'] = $entity->termList;
        return $response;
    }

    public function insertBulkTerms($termTypeId = 23, $termList = '', $parent_id = 0)
    {
        $termList = explode("\n", '
        Giyim ve Ayakkabı
        Elektronik
        Ev ve Yaşam
        Anne ve Bebek
        Kozmetik ve Kişisel Bakım
        Mücevher ve Saat
        Spor ve Outdoor
        Kitap, Müzik, Film, Oyun
        Bilet, Tatil ve Eğlence
        Tasit/Otomotil
        Tasit/Motosiklet
        Elektronik/Beyaz Eşya
        Elektronik/Bilgisayar, Donanım
        Elektronik/Fotoğraf, Kamera
        Elektronik/Klima, Isıtıcı Soğutucu
        Elektronik/Küçük Ev Aletleri
        Elektronik/Oyun, Oyun Konsolları
        Elektronik/Telefon
        Elektronik/TV, Ses, Görüntü Sistemleri
        Elektronik/Bilgisayar, Donanım/Bilgisayar Aksesuarları
        Elektronik/Bilgisayar, Donanım/Bilgisayar Bileşenleri
        Elektronik/Bilgisayar, Donanım/Bilgisayarlar
        Elektronik/Bilgisayar, Donanım/Çevre Birimleri
        Elektronik/Bilgisayar, Donanım/Fotokopi Makinesi
        Elektronik/Bilgisayar, Donanım/Monitör
        Elektronik/Bilgisayar, Donanım/Network Ürünleri
        Elektronik/Bilgisayar, Donanım/Notebook Yedek Parça
        Elektronik/Bilgisayar, Donanım/Sunucu
        Elektronik/Bilgisayar, Donanım/Veri Depolama
        Elektronik/Bilgisayar, Donanım/Yazıcılar, Aksesuarları
        Elektronik/Bilgisayar, Donanım/Yazılım
        Elektronik/Bilgisayar, Donanım/Bilgisayarlar/All in One Bilgisayar
        Elektronik/Bilgisayar, Donanım/Bilgisayarlar/Dizüstü Bilgisayar
        Elektronik/Bilgisayar, Donanım/Bilgisayarlar/Masaüstü Bilgisayar
        Elektronik/Bilgisayar, Donanım/Bilgisayarlar/Netbook
        Elektronik/Bilgisayar, Donanım/Bilgisayarlar/Tablet
        Elektronik/TV, Ses, Görüntü Sistemleri/Akıllı Ev Sistemleri
        Elektronik/TV, Ses, Görüntü Sistemleri/Güvenlik Sistemleri
        Elektronik/TV, Ses, Görüntü Sistemleri/MP3 Çalar
        Elektronik/TV, Ses, Görüntü Sistemleri/Projeksiyon Cihazı
        Elektronik/TV, Ses, Görüntü Sistemleri/Projeksiyon Cihazı Aksesuarı
        Elektronik/TV, Ses, Görüntü Sistemleri/Ses Kayıt Cihazı
        Elektronik/TV, Ses, Görüntü Sistemleri/Ses Sistemleri
        Elektronik/TV, Ses, Görüntü Sistemleri/Sinema Sistemi
        Elektronik/TV, Ses, Görüntü Sistemleri/Televizyon
        Elektronik/TV, Ses, Görüntü Sistemleri/Televizyon Aksesuarı
        Elektronik/TV, Ses, Görüntü Sistemleri/TV Box ve Medya Oynatıcı
        Elektronik/TV, Ses, Görüntü Sistemleri/Uydu Alıcısı
        Elektronik/TV, Ses, Görüntü Sistemleri/Uydu Alıcısı Aksesuarı
        Elektronik/TV, Ses, Görüntü Sistemleri/Yeni Nesil
        Elektronik/Telefon/Bluetooth Araç Kiti
        Elektronik/Telefon/Bluetooth Hoparlör
        Elektronik/Telefon/Bluetooth Kulaklık
        Elektronik/Telefon/Cep Telefonu
        Elektronik/Telefon/Cep Telefonu Aksesuarı
        Elektronik/Telefon/Yedek Parça
        Elektronik/Telefon/El Telsizi
        Elektronik/Telefon/Giyilebilir Teknoloji
        Elektronik/Telefon/Giyilebilir Teknoloji/Akıllı Bileklik
        Elektronik/Telefon/Giyilebilir Teknoloji/Akıllı Saat
        Elektronik/Telefon/Giyilebilir Teknoloji/Giyilebilir Teknoloji Aksesuarı
        Elektronik/Telefon/Giyilebilir Teknoloji/Sanal Gerçeklik Gözlüğü
        Elektronik/Telefon/Konferans Telefonu
        Elektronik/Telefon/Masaüstü Telefon
        Elektronik/Telefon/Navigasyon Cihazı
        Elektronik/Telefon/Operatör Başlığı
        Elektronik/Telefon/Taşınabilir Şarj Cihazı
        Elektronik/Telefon/Telefon Santrali
        Elektronik/Telefon/Telsiz Telefon
        ');
        $termList = array_filter($termList);

        foreach ($termList as $key => $termsOfLine) {
            $termsOfLine = explode('/', $termsOfLine);
            $parent_id = 0;
            $level = [$parent_id];
            foreach ($termsOfLine as $key => $termName) {
                $termName = trim($termName);
                if (!$termName) {
                    continue;
                }

                $level[] = $key;
                $parent_id = $this->insertTermVariant($termTypeId, $termName, $parent_id, count(array_filter($level)), '');
            }
        }

        return 0;
    }
/*
    public function insertTermTest(Request $request)
    {
        $this->insertBulkTerms();
        return 0;
    }

    public function insertTerm(Request $request, $type_id, $term_name)
    {
        $parent_id = 0;
        $level = 0;
        $count = 0;
        $term = Term::firstOrNew(['name' => $term_name, 'slug' => url_baslik_yarat($term_name)]);
        $term->save();

        $termId = $term->term_id;

        $termTax = $term->termVariant()->firstOrNew(['term_type_id' => $type_id, 'term_id' => $termId]);
        $termTax->save();
        return $termTax;
    }
    */

}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\BlogPost;

class UpdateAboutPage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        BlogPost::where('id', 1)
                ->update(
                    [
                        'title' => 'Historia ya Swahili Music Notes',
                        'text' => '	 	 	
<p>Swahili Music Notes (SMN), ni tovuti inayohifadhi nota za nyimbo za Kanisa Katoliki. Ilizaliwa tarehe 1 December 2011 na mwanzilishi wake ni ndugu Vusile Terence Silonda. Kwa nini alianzisha tovuti hii? Mwenyewe anaeleza: </p>
<img src="/images/1780713_10203261852694902_1527208734_n.jpg"  class="img-fluid rounded mx-auto d-block border border-success" style = "border-width: 3px !important; max-width: 80%; margin: 20px;" />
<p>
“Kwanza kabisa, ningependa watu wafahamu kuwa mimi ni Mwanakwaya, na nilianza kuimba mwaka 2002, katika kwaya ya Vijana ya Mt. Bakhita Parokia ya Upanga.
</p>
<p>
Kati ya mwaka 2007 – 2010, nilibahatika kuwa mwanafunzi wa Shahada ya Kwanza ya Computer Science, Loyola College, Chennai, nchini India. Nilianza chuo June 2007, ila sikujishughulisha na shughuli zozote za utume wa uimbaji. Kwa aliyewahi kuishi India, anafahamu kuwa kwaya zao za Kanisani, si kama kwaya zetu hapa, hawaimbi kwa mfumo wa SATB (sauti nne), sana sana, inakuwa kikundi cha waimbaji, wakitumia keyboard, kuimba kwa sauti moja, na baadhi wakifanya harmony kwa ubunifu tu, hivyo sikuvutwa sana kujiunga na utume.
</p>
<p>
Ilipofika muda fulani, nilivutwa na kujiunga na kwaya moja, ya watu kutoka madhehebu mbalimbali na sehemu mbalimbali za mji wa Chennai, iliyokuja pamoja kwa ajili ya kuimba concert ya Christmas. Kama kwaya ya Dar Choral Society. Unaweza kuiona concert hiyo YouTube kupitia link hii (ni ndefu kidogo) > <a href = "https://www.youtube.com/watch?v=Op39lBDPoqs">https://www.youtube.com/watch?v=Op39lBDPoqs</a>
</p>
<p>
Kutoka hapo, nilipata marafiki wengi wahindi, ambao kutokana nao, nilijiunga kwenye kwaya mbili. Moja ilikuwa ni kwaya iliyoimba Jumapili pale chuoni. Baadae hawa walikuwa marafiki zangu wa karibu sana katika historia yangu ya maisha India. Pili, ilikuwa kundi la waimbaji wanaume <strong>“Conspirito Singers”</strong> ambao tulikuwa tukikutana kwa ajili ya kwenda kuimba kwenye mialiko mbalimbali mjini Chennai.
</p>
<p>
Kusudi nifupishe maelezo, nilibahatika kufundisha kila kwaya walau wimbo mmoja wa Kiswahili. Kwenye kwaya ya chuo, nililazimika kufundisha wimbo wa Ki-protestant, kwa kuwa ulikuwa mrahisi kwao kushika, kwa kuwa hawakuwa na uzoefu kuimba SATB. Kwa Conspirito Singers niliwafundisha wimbo wa <strong>“Kesheni Kila Wakati”</strong> kutoka kwenye Kitabu cha Liturjia, ambacho nilibahatika kupata niliporudi likizo mwaka wa Kwanza.
</p>
<p>
Hapa ndo historia ya SMN inapoanzia, Ilibidi ninunue kitabu hicho kwa kuwa ilikuwa ngumu sana kupata hizo nyimbo vinginevyo. Matumizi ya email bado hayakuwa makubwa sana, hivyo kupata nyimbo ilikuwa ni mtihani kweli. Kitabu cha Liturjia, ni kweli kilikuwa na nyimbo, ila sio nyimbo zote ambazo nilitamani ziimbwe. Wazo hasa lilizaliwa katika kipindi hichi. Sikulifanyia kazi, ila lilikuwa lipo kwenye akili yangu.
</p>
<p>
Niliporudi kutoka India, baada ya kipindi kifupi, mwaka 2011, lilianzishwa kundi la Facebook la Fr. Kayeta, nadhani lilianzishwa na Deo Mhumbira. Nami nilijiunga. Nilipojiunga, niliona watu wengi sana wakiombana nota ya nyimbo mbalimbali na kuzituma humo. Mara moja, nilikumbuka wazo langu. Sikuchelewa, nikalifanyia kazi, ingawa haikuwa katika ubora, na ikaanza kufanya kazi December 1, 2011. Nilijishauri sana ni jina gani niite. Kulikuwa na wazo la kuita Catholic Swahili Music Notes (Ila niliona jina hili ni refu sana). Pia, nilikuwa na wazo kuwa, pengine siku moja SMN itatunza zaidi ya nyimbo za Kanisa Katoliki, hii ni sababu kubwa ya kuondoa neno Catholic.
</p>
<p>
Kuanzia hapo, nadhani sihitaji kusema mengi. SMN imetoka kutoka nyimbo 7 – 10 za awali, na leo ina nyimbo 13,500+. Wimbo wa kwanza kabisa ulikuwa ni: Dondokeni Enyi Mbingu uliotungwa na John Mgandu. Mnaweza kuona, SMN ilianza kipindi cha majilio, na wimbo huu ni wa majilio. Unaweza kuuona wimbo huu hapa > <a href = "http://www.swahilimusicnotes.com/wimbo/dondokeni-enyi-mbingu/18">Dondokeni Enyi Mbingu - John Mgandu</a>
</p>
<p>
Katika miaka 7, namshukuru Mungu, nimeweza kufanya maboresho makubwa manne kutokana na mahitaji ya watumiaji. Katika kila hatua nilifanya maboresho fulani.
</p>
<p>
SMN version ya kwanza kabisa naiita <strong>“Mwanzo” (Dec 2011)</strong>: Maana ndo ulikuwa mwanzo wa safari ya SMN. SMN hii ilikuwa hafifu sana kwenye technolojia. Ilikuwa simple sana. Nyimbo zote zilikuwa zinaonekana kwenye ukurasa wa mwanzo kabisa wa nyumbani ukifungua tu SMN. Hii ilianza kuwa changamoto, nyimbo zilipoanza kuwa nyingi. Viashiria vya kama wimbo una Midi na Maneno vilianza pia kuonekana kwenye SMN hii. Mwonekano wake ni kama hapa chini:
<img src="/images/SMN-1.png" class="img-fluid rounded mx-auto d-block border border-success" style = "border-width: 3px !important; max-width: 80%; margin: 20px;" />
</p>
<p>
SMN version ya pili naiita <strong>“Mwelekeo” (June 2012)</strong>: SMN hii ndo kwanza ilianza kuonesha makundi nyimbo na kuziweka nyimbo kwenye makundi nyimbo. Pia, ilianza kuonesha nyimbo za watunzi fulani na historia za watunzi. Kwenye SMN hii pia, ndo nilianza kuboresha “search” njia ya kutafuta nyimbo maana zilianza kuwa nyingi. Pia, nikaanza kupata ushirikiano wa watu wengi kwenye ku-upload nyimbo. Pia SMN ndo ilikuwa ya kwanza KUKUSANYA takwimu za mara ngapi wimbo umepakuliwa. Mwonekano wake ni kama hapa chini:
<img src="/images/SMN-2.png" class="img-fluid rounded mx-auto d-block border border-success" style = "border-width: 3px !important; max-width: 80%; margin: 20px;" />
</p>
<p>
SMN version ya tatu naiita <strong>“Simu Kwanza” (May 2016)</strong>: SMN hii ndo ilikuwa ya kwanza kuweka mkazo kwenye muonekano mzuri wa SMN kwenye simu, maana 85% ya watumiaji wa SMN wanaitumia kwa kutumia simu zao za mkononi. Hivyo ilikuwa muhimu sana kufanya maboresho hayo. Pia maboresho mengine yaliyofanyika ni kwenye kupakia nyimbo na kusearch. Pamoja na kuanza KUONESHA ni mara ngapi wimbo umepakuliwa (Umekuwa downloaded). Pia nilibadili mwonekano, na kuhamishia makundi nyimbo kwenye ukurasa wake, huku ukurasa wa mbele ukionesha nyimbo “zinazovuma” wiki hiyo n.k. Wadau wengi, wanaifahamu zaidi SMN hiyo. Mwonekano wake ni kama hapa chini:
<img src="/images/SMN-3.png" class="img-fluid rounded mx-auto d-block border border-success" style = "border-width: 3px !important; max-width: 80%; margin: 20px;"/>
</p>
<p>
SMN version ya nne naiita <strong>“Mwerevu, Mjanja (Smart)” (December 2018)</strong>: SMN hii ina maboresho makubwa sana zaidi ya yanayoonekana. Ni “Overhaul” kubwa sana, kuanzia kwenye “database” inayoendesha SMN na mwonekano pia. Ndio maana maboresho yamewezekana kwenye speed, upakiaji wa nyimbo, mwonekano, kuhakiki nyimbo na kadhalika. Lakini pia SMN imepata uwezo wa kutabiri mambo mbalimbali, ikiwemo, iwapo wimbo unatumika kwenye dominika, na iwapo kama wimbo unaopakia umo tayari kwenye tovuti na mengine mengi.
</p>
<p><strong>Changamoto:</strong><br>
Siwezi kuongelea historia bila kuzungumzia changamoto. SMN imepata changamoto nyingi na wakati mwingine zilikaribia kunikatisha tamaa. Kuna wanaoipinga, bila kuielewa vizuri. Kuna wanaoikosoa kwa makosa kwenye nota, hata kama makosa hayo hayakuanzia kwenye SMN, maana hata vitabu vilivyochapwa, vina makosa. Na changamoto nyinginezo. Ila katika yote, nimejifunza kuwa changamoto zinasaidia kukua.
</p>
<p><strong>Kukabidhi SMN kwa Kanisa:</strong><br>
Mnamo May 2017. Niliridhia kwa moyo safi na kwa kutaka mwenyewe SMN imilikiwe na Kanisa. Nilitoa SMN kama zawadi, bure kabisa bila kujali gharama zote ambazo nimezipata kuiendesha. Nia kubwa ya kuigawa bure kwa Kanisa ni kwa sababu nilitambua itapata usimamizi mzuri zaidi, huku mimi nikibaki kuwa mshauri wa masuala ya Teknolojia. Nashukuru kuwa Kanisa, kupitia Askofu Salutaris Libena, lilikubali kuipokea na mpaka sasa tupo kwenye mchakato wa Kanisa kuipokea.
</p>
<p><strong>Shukrani:</strong><br>
Siwezi kuwataja na kuwamaliza watu wote ambao wamechangia SMN kufika hapa ilipo ni wengi sana. Ila wafuatao wanastahili kutajwa: Deo Mhumbira, Bernard Mukasa, Albert Maneno, Fr. Deo Mwageni, Yudathadei Chitopela, Augustine Ruta, Martin Munywoki, Beatus Idama na wengine wengi sana ambao mara nyingi tumekuwa tukiongea kwenye simu na kubadilishana mawazo ili kuiboresha SMN. Mungu awabariki sana.</p>'
                    ]
                );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

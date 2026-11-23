<?php

namespace App\Http\Traits;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Album;
use App\Models\Awards;
use App\Models\Events;
use App\Models\Slider;
use App\Models\Patrons;
use App\Models\Documents;
use App\Models\Results;
use App\Models\Education;
use App\Models\AssociationNews;
use App\Models\AntiDoping;
use App\Models\Department;
use App\Models\Governance;
use App\Models\HallOfFame;
use App\Models\Management;
use App\Models\NewsEvents;
use App\Models\Taekwondo;
use App\Models\AssociationAlbum;
use App\Models\AssociationVideo;
use App\Models\VideoAlbum;
use App\Models\Association;
use App\Models\EventSlider;
use App\Models\EventsVideo;
use App\Models\Secretariat;
use App\Models\AssociationSlider;
use App\Models\DefaultAssociation;
use App\Models\EventProfile;
use App\Models\EventResults;
use App\Models\ImageGallery;
use App\Models\AssociationPatrons;
use App\Models\AssociationProfile;
use App\Models\VideoGallery;
use App\Models\DefaultEvents;
use App\Models\MemberProfile;
use App\Models\AssociationCommittee;
use App\Models\AssociationDocuments;
use App\Models\CommitteeMember;
use App\Models\AssociationGovernance;
use App\Models\AssociationVideoAlbum;
use App\Models\EventsVideoAlbum;
use App\Models\PresidentMessage;
use App\Models\EventImageGallery;
use App\Models\AssociationImageGallery;
use App\Models\ImportantPDFEvents;
use App\Models\RulesAndRegulations;
use App\Models\AssociationCommitteeMember;
use App\Models\AssociationPresidentMessage;
use App\Models\AssociationSecretaryMessage;

use Illuminate\Support\Facades\Auth;

trait SocialMediaTrait
{

    public function socialMedia($path) {

        $shareComponent= \Share::page(
            $path,         
        )
        ->facebook()
        ->twitter()
        ->linkedin()
        ->telegram()
        ->whatsapp()        
        ->reddit();

        return $shareComponent;
    }
}

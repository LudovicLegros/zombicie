<?php

namespace App\Controller\Admin;

use App\Entity\Skill;
use App\Entity\Survivant;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SurvivantCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Survivant::class;
    }

    public function configureFields(string $pageName): iterable
    {

        return [
            TextField::new('nom'),
            TextEditorField::new('description'),
            ImageField::new('image')
                ->setBasePath('uploads/images/')
                ->setUploadDir('public/uploads/images/'),
            AssociationField::new('blueskill1','Bleu'),
            AssociationField::new('blueskill2','Bleu 2'),
            AssociationField::new('yellowskill', 'Jaune'),
            AssociationField::new('orangeskill1' ,'Orange 1'),
            AssociationField::new('orangeskill2','Orange 2'),
            AssociationField::new('redskill1','Rouge 1'),
            AssociationField::new('redskill2','Rouge 2'),
            AssociationField::new('redskill3','Rouge 3'),

        ];
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}

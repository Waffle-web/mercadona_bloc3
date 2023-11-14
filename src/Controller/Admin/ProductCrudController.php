<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    
    public function configureFields(string $pageName): iterable
    {

$mappingParams = $this->getParameter('vich_uploader.mappings');
$productsImagePath = $mappingParams['product']['uri_prefix'];


        yield TextField::new('name', 'Nom');
        yield MoneyField::new('price', 'Prix')->setCurrency('EUR');
        yield TextareaField::new('description');
        yield TextAreaField::new('imageFile', 'Image')->setFormType(VichImageType::class)->hideOnIndex();
        yield ImageField::new('imageName')->setBasePath($productsImagePath)->hideOnForm();  
        yield AssociationField::new('category', 'Catégories');
        yield AssociationField::new('promo', 'Promotion');
    }
    
}

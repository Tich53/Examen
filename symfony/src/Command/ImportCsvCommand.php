<?php

namespace App\Command;

use App\Entity\Category;
use App\Entity\Product;

use App\Entity\ProductPriceHistorical;

use App\Repository\TagRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

#[AsCommand(
    name: 'ImportCsv',
    description: 'Importer un fichier CSV pour le client komparotoparts.com',
)]
class ImportCsvCommand extends Command
{
    private SymfonyStyle $io;

    public function __construct(
        private EntityManagerInterface $entityManager,
        private string $dataDirectory,

        private TagRepository $tagRepository,

    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Importer des données à partir d\'un fichier CSV');
    }

    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        $this->io = new SymfonyStyle($input, $output);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->importProduct();
        return Command::SUCCESS;
    }

    private function getDataFromFile(): array
    {

        $file = $this->dataDirectory . 'spycommerce.csv';


        $fileExtension = pathinfo($file, PATHINFO_EXTENSION);

        $normalizers = [new ObjectNormalizer()];

        $encoders = [new CsvEncoder()];

        $serializer = new Serializer($normalizers, $encoders);

        /** @var string $fileString */

        $fileString = file_get_contents($file);

        $data = $serializer->decode($fileString, $fileExtension);

        return ($data);
    }

    private function importProduct(): void
    {
        $this->io->section('IMPORT DU FICHIER');


        $productToImport = 0;


        // vérifie à quel client associer le fichier CSV

        $website = $this->entityManager->getRepository('App\Entity\Website')
            ->findOneBy([
                'url' => ['https://komparotoparts.com/']
            ]);


        $tag = $this->tagRepository->findOneBy([
            'name' => ['Top reference']
        ]);

        foreach ($this->getDataFromFile() as $row) {


            $productToImport++;
        }

        $this->io->progressStart($productToImport);

        $productImported = 0;

        foreach ($this->getDataFromFile() as $row) {


            // vérifie si la catégorie est présente sur la table.

            $category = $this->entityManager->getRepository('App\Entity\Category')
                ->findOneBy([
                    'name' => $row['titre']
                ]);

            // Ajoute la catégorie si elle n'est pas présente.

            if ($category === null) {
                $category = (new Category())
                    ->setName($row['titre']);

                $this->entityManager->persist($category);

                $this->entityManager->flush();
            }

            $product = (new Product())
                ->setRawBrand($row['marque'])

                ->setCleanedBrand(preg_replace('/[^\p{L}\p{N}]/u', '', strtolower($row['marque'])))
                ->setRawReference($row['sku'])
                ->setCleanedReference(preg_replace('/[^\p{L}\p{N}]/u', '', strtolower($row['sku'])))
                ->setUrl($row['url'])
                ->setName($row['titre'])
                ->setImage($row['image'])

                ->setCategory($category)
                ->setWebsite($website);
            if ($row['topref_spy']) {
                $product->addTag($tag);
            }


            $productPriceHistorical = (new ProductPriceHistorical())
                ->setProduct($product)
                ->setPrice($product->getPrice());

            $this->entityManager->persist($product);
            $this->entityManager->persist($productPriceHistorical);
            $productImported++;

            if ($productImported === 30000) {
                $this->entityManager->clear();
                $productImported = 0;
                $website = $this->entityManager->getRepository('App\Entity\Website')
                    ->findOneBy([
                        'url' => ['https://komparotoparts.com/']
                    ]);
                $tag = $this->tagRepository->findOneBy([
                    'name' => ['Top reference']
                ]);
            }
            $this->io->progressAdvance();
        }
        $this->entityManager->flush();
        $this->entityManager->clear();
        $this->io->progressFinish($productToImport);

        if ($productToImport > 1) {
            $string = "{$productToImport} PRODUITS IMPORTES.";
        } elseif ($productToImport === 1) {

            $string = "1 PRODUIT IMPORTE.";
        } else {
            $string = "AUCUN PRODUIT N'A ETE IMPORTE.";
        }

        $this->io->success($string);
    }
}

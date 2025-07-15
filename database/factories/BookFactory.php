<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $statuts = ['lu', 'à lire', 'en cours'];
        $auteurs = [
            'Victor Hugo' , 'Marcel Proust', 'Albert Camus', 'Simone de Beauvoir', 'Jean-Paul Sartre',
            'Marguerite Duras', 'Antoine de Saint-Exupéry', 'Émile Zola', 'Guy de Maupassant', 'Alexandre Dumas', 'Honoré de Balzac', 'George Orwell', 'J.K. Rowling', 'Stephen King', 'Agatha Christie', 'Ernest Hemingway', 'F. Scott Fitzgerald', 'Jane Austen', 'Charles Dickens', 'Freida McFadden'
        ];
        $titres = [
            'Les Misérables', 'Notre-Dame de Paris', 'Le Petit Prince', 'L\'Étranger', 'La Peste', 'Le Deuxième Sexe', 'À la recherche du temps perdu', 'Germinal', 'Madame Bovary', 'Le Comte de Monte-Cristo', 'Les Trois Mousquetaires', '1984', 'Harry Potter à l\'école des sorciers','Shining', 'Le Crime de l\'Orient-Express', 'Le Vieil Homme et la Mer', 'Gatsby le Magnifique', 'Orgueil et Préjugés', 'Oliver Twist', 'Jane Eyre', 'Les Fleurs du mal',
            'Candide', 'Le Rouge et le Noir', 'Bel-Ami', 'Nana', 'L\'Assommoir', 'La Femme de Ménage'

        ];
        return [
            //
            'titre' => $this->faker->randomElement($titres),
            'auteur' => $this->faker->randomElement($auteurs),
            'annee' => $this->faker->numberBetween(1800, 2024),
            'statut' => $this->faker->randomElement($statuts),
            'favori' => $this->faker->boolean(30), // 30% de chance d'être favori
            'note' => $this->faker->optional(0.7)->paragraph(), // 70% de chance d'avoir une note
        ];
    }
}

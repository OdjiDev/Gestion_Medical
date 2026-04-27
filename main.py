import flet as ft

def main(page: ft.Page):
    # Configuration de la page
    page.title = "Ma Solution Numérique"
    page.theme_mode = ft.ThemeMode.LIGHT
    page.horizontal_alignment = ft.CrossAxisAlignment.CENTER
    
    # Composants de l'interface
    titre = ft.Text("Bienvenue dans mon App", size=30, weight="bold")
    champ_nom = ft.TextField(label="Entrez votre nom", width=300)
    resultat = ft.Text(size=20, color="blue")

    def valider_clic(e):
        if champ_nom.value:
            resultat.value = f"Bonjour, {champ_nom.value} !"
            page.update()

    # Ajout des éléments à l'écran
    page.add(
        titre,
        champ_nom,
        ft.ElevatedButton("Valider", on_click=valider_clic),
        resultat
    )

# Lancer l'application
ft.app(target=main)
function ConfirmMessage() 
{	
	alert('coucou');
	if (confirm("Etes vous sûr de vouloir réinitaliser le tableau ?")) 
	{ 
		// Clic sur OK
		echo "c'est confirmé";
	}
	else
	{
		echo "pas confirmé";
	}
}

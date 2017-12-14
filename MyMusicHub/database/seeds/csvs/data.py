import pandas as pd
import ipdb

def main() :
    artist = pd.read_csv(
        "artists2.csv",
        header=0
    ).dropna(
        axis=1,
        how='all'
    )

    track = pd.read_csv(
        "tracks2.csv",
        header=0,
        encoding='latin1',
        dtype=str,
    ).dropna(
        axis=1,
        how='all'
    )

    album = pd.read_csv(
        "albums2.csv",
        header=0,
        encoding='latin1',
        dtype=str,
    ).dropna(
        axis=1,
        how='all'
    ).drop(
        ['Unnamed: 5', 'Unnamed: 3', 'Unnamed: 4'],
        axis=1
    )

    data = track.join(
        artist.set_index('ArtistTitle'),
        on='TrackArtist'
    ).join(
        album.set_index('AlbumId'),
        on='AlbumId'
    )

    data[[
        'TrackId',
        'TrackName',
        'TrackDuration',
        'TrackArtist',
        'AlbumId',
        'ArtistId'
    ]].dropna().to_csv('tracks3.csv', index=False)

if __name__ == "__main__":
    main()
